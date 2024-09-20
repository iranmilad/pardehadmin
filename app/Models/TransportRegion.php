<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRegion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'regions',
        'cost_type',
        'price',
        'user_id',
        'percentage_of_cart_value',
        'weight_based_cost',
        'dimension_based_cost',
    ];

    protected $casts = [
        'regions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateCost($cartValue, $weight, $dimensions)
    {
        switch ($this->cost_type) {
            case 'fixed_rate':
                return $this->price;
            case 'value_based':
                return ($this->percentage_of_cart_value / 100) * $cartValue;
            case 'weight_based':
                return $this->weight_based_cost * $weight;
            case 'volume_based':
                $volume = $dimensions['length'] * $dimensions['width'] * $dimensions['height'];
                return $this->dimension_based_cost * $volume;
            default:
                return 0;
        }
    }
}
