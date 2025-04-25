<?php

namespace App\Models;

use App\Traits\Searchable;
use App\Models\AttributeItem;
use Illuminate\Support\Facades\Auth;
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
        'sku',
        'time_per_unit',
        'type',
        'is_top',
        'is_new',
        'img',
        'hover_img',
        'service',
        'description',
        'delivery_type',
        'weight',
        'length', // اضافه کردن فیلد طول
        'width',  // اضافه کردن فیلد عرض
        'height',  // اضافه کردن فیلد ارتفاع
        'measurement_unit',
        'transport_type',
        'cost_calculation_class',
        'status',
        'reviews_enabled',
    ];

    protected $casts = [
        'is_top' => 'boolean',
        'is_new' => 'boolean',
        'service' => 'boolean',
        'reviews_enabled' => 'boolean',
    ];

    /**
     * Accessor for sale_price.
     * If the user has the 'wholesale' role, return wholesale_price instead of sale_price.
     *
     * @return float|null
     */
    public function getSalePriceAttribute()
    {
        // Check if the user is logged in and has the 'wholesale' role
        if (Auth::check() && Auth::user()->hasRole('wholesale')) {

            return $this->wholesale_price ?? $this->attributes['sale_price'];
        }

        // Otherwise, return the regular sale price
        return $this->attributes['sale_price'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        if ($this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100) ."%";
        }

        return 0;
    }

    public function isAvailable(): bool
    {
        if($this->service) return true;

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
        if($this->service) return true;

        switch ($this->inventory_display) {
            case 'few':
                return $this->few ?? 0;
            case 'fewspd':
                return $this->fewspd ?? 0;
            case 'fewtak':
                return $this->fewtak ?? 0;
            default:
                return 0;
        }
    }

    public function getLinkAttribute()
    {
        return (env("Host_URL")."/product/".$this->id);
    }

    public function hasMinimumQuantity(): bool
    {
        return $this->minimum_quantity !== null && $this->quantity <= $this->minimum_quantity;
    }

    public function inventoryMessage(): string
    {
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

    public function firstCategory()
    {
        return $this->categories()->first();
    }

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
        return round($this->reviews()->avg('rating'), 2);
    }

    public function qualityRatingAverage()
    {
        return round($this->reviews()->avg('quality'), 2);
    }

    public function performanceRatingAverage()
    {
        return round($this->reviews()->avg('performance'), 2);
    }

    public function designRatingAverage()
    {
        return round($this->reviews()->avg('design'), 2);
    }

    public function priceRatingAverage()
    {
        return round($this->reviews()->avg('price'), 2);
    }

    public function easeOfUseRatingAverage()
    {
        return round($this->reviews()->avg('ease_of_use'), 2);
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
        return $this->belongsToMany(CreditPlan::class, 'credit_plan_products', 'product_id', 'credit_plan_id');
    }

    public function creditInstallmentTimeline($totalAmount)
    {
        $creditPlanProduct = $this->creditPlanProduct()->first();
        if ($creditPlanProduct) {
            $creditPlan = $creditPlanProduct->creditPlan;
            $numberOfInstallments = $creditPlan->installments_count;
            $totalCredit = $creditPlan->credit_percentage * $totalAmount / 100;
        } else {
            $numberOfInstallments = 0;
            $totalCredit = 0;
        }

        $installmentAmount = ($numberOfInstallments != 0) ? $totalCredit / $numberOfInstallments : 0;
        $timeline = [];

        for ($i = 1; $i <= $numberOfInstallments; $i++) {
            $timeline[$i] = (object) [
                'month' => $i,
                'amount' => $installmentAmount,
            ];
        }

        return (object) ["timeline" => $timeline, "totalCredit" => $totalCredit];
    }

    public function getDateShamsiAttribute()
    {
        $gregorianDate = \Carbon\Carbon::parse($this->due_date);
        $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($gregorianDate);
        return $jalaliDate->format('Y/m/d');
    }

    public function attributeCombinations()
    {
        return $this->hasMany(ProductAttributeCombination::class);
    }

    public function getCombinations()
    {
        return $this->attributeCombinations()->with('attributeProperties.attribute', 'attributeProperties.property')->get();
    }

    // رابطه‌ی بسیار به بسیار با تخفیف‌ها
    public function discountCodes()
    {
        return $this->belongsToMany(DiscountCode::class, 'discount_product', 'product_id', 'discount_code_id');
    }

    public function calculateTotalPriceWithAttributes()
    {
        $totalPrice = 0;
        $attributes = $this->attributes()->get();

        foreach ($attributes as $attribute) {
            $firstItem = $attribute->properties()->first();
            if ($firstItem) {
                $combination = $firstItem->attributeCombinations->firstWhere('product_id', $this->id);
                if ($combination) {
                    $totalPrice += $combination->price;
                }
            }
        }

        return $totalPrice;
    }

    public function getCombinationDetails($attributes)
    {
        // شروع با تمام ترکیب‌های محصول
        $combinations = $this->attributeCombinations();

        // فیلتر کردن بر اساس هر ویژگی و خصوصیت انتخاب شده
        foreach ($attributes as $attributeId => $propertyId) {
            $combinations = $combinations->whereHas('attributeProperties', function($query) use ($attributeId, $propertyId) {
                $query->where('attribute_id', $attributeId)
                      ->where('property_id', $propertyId);
            });
        }
        // برای نمایش کوئری SQL
        //dd($combinations->toSql(), $combinations->getBindings());
        // برگرداندن اولین ترکیب پیدا شده که مطابق با ویژگی‌ها باشد
        return $combinations->first();
    }


    /**
     * دریافت جزئیات ترکیب مستقل ویژگی.
     *
     * @param int $attributeId
     * @param mixed $selectedValue
     * @return ProductAttributeCombination|null
     */
    public function getIndependentCombinationDetails($attributeId, $selectedValue)
    {

        // یافتن ترکیب بر اساس ویژگی مستقل و property_id
        return $this->attributeCombinations()
            ->whereHas('attributeProperties', function ($query) use ($attributeId, $selectedValue) {
                $query->where('attribute_id', $attributeId)
                    ->where('property_id', $selectedValue);
            })
            ->first();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->regular_price * (1 - $this->discount / 100);
    }

    // در مدل Product
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_supplier', 'product_id', 'supplier_id')
            ->withPivot('combination_id');
    }

    public function priceHistories()
    {
        return $this->hasMany(ProductPriceHistory::class)
            ->latest() // ترتیب نزولی بر اساس تاریخ
            ->take(12); // گرفتن 12 رکورد آخر
    }

    public function productSuppliers()
    {
        return $this->hasMany(ProductSupplier::class);
    }

    public function getImgAttribute($value)
    {
        return $value ?? asset('images/blank_image.jpg');
    }


    /**
     * بررسی موجود بودن کلی محصول (با در نظر گرفتن ترکیب‌ها)
     *
     * @return bool
     */
    public function isFullyAvailable(): bool
    {
        // اگر محصول ساده (بدون ترکیب) و موجود باشد
        if ($this->type=="simple" and $this->isAvailable()) {
            return true;
        }
        else{
            // اگر ترکیب‌هایی دارد، بررسی کنیم که آیا حداقل یکی از آنها موجود است یا نه
            return $this->attributeCombinations()
                        ->where(function ($query) {
                            $query->where('stock_quantity', '>', 0);
                        })
                        ->exists();

        }

    }


}
