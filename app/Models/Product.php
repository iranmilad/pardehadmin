<?php

namespace App\Models;

use App\Traits\Searchable;
use App\Models\AttributeItem;
use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Money\Money;
use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    use Searchable;
    protected $perPage = 6;

    protected $fillable = [
        'title',
        'price',
        'sale_price',
        'wholesale_price',
        'few',
        'fewspd',
        'fewtak',
        'holo_code',
        'type',
        'is_top',
        'is_new',
        'img',
        'hover_img',
        'service',
        'description',
        'delivery_type',
        'status'
    ];

    protected $casts = [
        'is_top' => 'boolean',
        'is_new' => 'boolean',
        'service' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function waitingLists()
    {
        return $this->hasMany(ProductWaitingList::class);
    }

    public function isUserInWaitingList($userId)
    {
        return $this->waitingLists()->where('user_id', $userId)->exists();
    }


    public function getDiscountPercentageAttribute()
    {
        // Calculate discount percentage
        if ($this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100) ."%";
        }

        return 0;
    }

    public function isAvailable(): bool
    {
        // Check if the product is available based on the inventory display type
        switch ($this->inventory_display) {
            case 'few':
                return $this->few > 0;
            case 'fewspd':
                return $this->fewspd > 0;
            case 'fewtak':
                return $this->fewtak > 0;
            default:
                return false;
        }
    }

    public function getQuantityAttribute()
    {
        switch ($this->inventory_display) {
            case 'few':
                return $this->few ?? 0;
            case 'fewspd':
                return $this->fewspd ?? 0;
            case 'fewtak':
                return $this->fewtak ?? 0;
            default:
                return 0; // Return 0 if inventory display setting is not specified
        }
    }

    public function getLinkAttribute()
    {
        return ("/product/".$this->id);

    }
    public function hasMinimumQuantity(): bool
    {
        // Check if the product has a minimum quantity requirement
        return $this->minimum_quantity !== null && $this->quantity <= $this->minimum_quantity;
    }

    public function inventoryMessage(): string
    {
        // Generate a message based on inventory and minimum quantity
        if ($this->isAvailable()) {
            if ($this->hasMinimumQuantity()) {
                return "{$this->minimum_quantity} عدد در انبار";
            } else {
                return 'موجود';
            }
        } else {
            return 'ناموجود';
        }
    }


    public function searchTooltips(string $query): array
    {
        $result = $this
            ->where('title', 'like', $query . '%')
            ->get();
        return $result->pluck('title')->all();
    }

    public function search(string $query)
    {
        $query = str_replace(['_', '%'], ['\_', '\%'], $query);
        return $this
            ->where('title', 'like', '%' . $query . '%')
            ->get();
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'product_id', 'attribute_id');
    }

    // Define a method to retrieve the first category of the product
    public function firstCategory()
    {
        return $this->categories()->first();
    }

    // Define a static method to retrieve the first category of a product
    public static function getFirstCategory($productId)
    {
        return static::findOrFail($productId)->firstCategory();
    }

    public function countProducts()
    {
        return $this->count();
    }


    public function calculatePageCount($perPage)
    {
        $totalCount = $this->countProducts();
        return ceil($totalCount / $perPage);
    }

    public function article()
    {
        return $this->hasOne(Article::class);
    }

    public function countRatings($rating)
    {
        return $this->reviews()->where('rating', $rating)->count();
    }

    public function overallRatingAverage()
    {
        return round($this->reviews()->avg('rating'),2);
    }

    public function qualityRatingAverage()
    {
        return round($this->reviews()->avg('quality'),2);
    }

    public function performanceRatingAverage()
    {
        return round($this->reviews()->avg('performance'),2);
    }

    public function designRatingAverage()
    {
        return round($this->reviews()->avg('design'),2);
    }

    public function priceRatingAverage()
    {
        return round($this->reviews()->avg('price'),2);
    }

    public function easeOfUseRatingAverage()
    {
        return round($this->reviews()->avg('ease_of_use'),2);
    }


    public function findAttributeItem($attributeId, $attributeName)
    {
        return AttributeItem::where('attribute_id', $attributeId)
                            ->where('name', $attributeName)
                            ->first();
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function credits()
    {
        return $this->belongsToMany(Credit::class);
    }



    public function creditPlanProduct()
    {
        return $this->hasMany(CreditPlanProduct::class);
    }


    public function creditPlans()
    {
        return $this->belongsToMany(CreditPlan::class);
    }


    /**
     * Get the credit installment timeline for the product.
     *
     * @param float $totalAmount
     * @return object
     */
    public function creditInstallmentTimeline($totalAmount)
    {
        $creditPlanProduct=$this->creditPlanProduct()->first();
        if ($creditPlanProduct){
            $creditPlan = $creditPlanProduct->creditPlan;
            $numberOfInstallments = $creditPlan->installments_count ;
            $totalCredit = $creditPlan->credit_percentage * $totalAmount / 100;
        }
        else {
            // اگر محصول به هیچ CreditPlan مرتبط نبود
            $numberOfInstallments = 0;
            $totalCredit = 0;
        }


        $installmentAmount = ($numberOfInstallments != 0) ? $totalCredit / $numberOfInstallments : 0;
        $timeline = [];

        // محاسبه زمان‌های هر قسط اعتباری
        for ($i = 1; $i <= $numberOfInstallments; $i++) {
            $timeline[$i] = (object) [
                'month' => $i,
                'amount' => $installmentAmount,
            ];
        }

        return (object) ["timeline" => $timeline, "totalCredit" => $totalCredit];
    }
}
