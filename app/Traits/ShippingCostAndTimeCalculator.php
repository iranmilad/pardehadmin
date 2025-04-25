<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Region;
use App\Models\TransportRegion;
use Illuminate\Support\Facades\Log;

trait ShippingCostAndTimeCalculator
{
    public function deliveryCost()
    {
        $order = $this;
    
        if (!$order->shipping_city || !$order->shipping_province) {
            return [];
        }
    
        $transportRegions = TransportRegion::all();
        $deliveryOptions = [];
    
        foreach ($transportRegions as $region) {
            // بررسی اینکه آیا شهر مشتری در این منطقه تعریف شده است
            if (empty($region->regions) || in_array($order->shipping_province, $region->regions)) {
                $totalCost = 0;
    
                foreach ($order->orderItems as $orderItem) {
                    $product = $orderItem->product;
                    $cartValue = $orderItem->total;
                    $weight = $product->weight;
                    $dimensions = [
                        'length' => $product->length,
                        'width' => $product->width,
                        'height' => $product->height,
                    ];
    
                    // محاسبه هزینه برای هر آیتم سبد بر اساس cost_type تعریف شده
                    $totalCost += $region->calculateCost($cartValue, $weight, $dimensions);
                }
    
                // اضافه‌کردن گزینه ارسال با عنوان روش و مقدار هزینه
                $deliveryOptions[] = [
                    'title' => $region->title,
                    'cost' => (int) $totalCost,
                    'region_id' => $region->id,
                    'type' => $region->cost_type,
                ];
            }
        }
    
        return $deliveryOptions;
    }
    
    /**
     * Calculate the shipping cost based on the delivery type and region.
     *
     * @param Region $region
     * @param string $deliveryType
     * @return float
     */
    private function calculateCostBasedOnDeliveryType($region, $deliveryType)
    {
        // به عنوان مثال: اگر تحویل درب منزل باشد، هزینه بالاتر است
        switch ($deliveryType) {
            case 'home_delivery':
                return $region->home_delivery_cost;
            case 'self_delivery':
                return $region->self_delivery_cost;
            default:
                return 0;
        }
    }

    /**
     * Calculate the delivery time based on the delivery type and region.
     *
     * @param Region $region
     * @param string $deliveryType
     * @return int
     */
    private function calculateDeliveryTime($region, $deliveryType)
    {
        // به عنوان مثال: اگر تحویل درب منزل باشد، زمان بیشتری می‌برد
        switch ($deliveryType) {
            case 'home_delivery':
                return $region->home_delivery_time;
            case 'self_delivery':
                return $region->self_delivery_time;
            default:
                return 0;
        }
    }

    /**
     * Calculate the estimated delivery date based on the current date and delivery time.
     *
     * @param int $deliveryTime
     * @return string
     */
    public function calculateEstimatedDeliveryDate($deliveryTime)
    {
        $currentDate = Carbon::now();
        $estimatedDeliveryDate = $currentDate->addDays($deliveryTime);

        return $estimatedDeliveryDate->toDateString(); // تاریخ تحویل تخمینی
    }

    private function calculateWeightBasedCost($region, $weight)
    {
        return $region->weight_based_cost * $weight;
    }

    private function calculateValueBasedCost($region, $cartValue)
    {
        return $region->percentage_of_cart_value * $cartValue;
    }

    private function calculateVolumeBasedCost($region, $dimensions)
    {
        $volume = $dimensions['length'] * $dimensions['width'] * $dimensions['height'];
        return $region->dimension_based_cost * $volume;
    }


    public function getDeliveryOptions()
    {
        $order = $this;
    
        if (!$order->shipping_city || !$order->shipping_province) {
            return [];
        }
    
        $transportRegions = TransportRegion::all();
        $options = [];
    
        foreach ($transportRegions as $region) {
            if (empty($region->regions) || in_array($order->shipping_province, $region->regions)) {
                $total = 0;
    
                foreach ($order->orderItems as $orderItem) {
                    $product = $orderItem->product;
                    $weight = $product->weight;
                    $dimensions = [
                        'length' => $product->length,
                        'width' => $product->width,
                        'height' => $product->height,
                    ];
                    $value = $orderItem->total;
    
                    $total += $region->calculateCost($value, $weight, $dimensions);
                }
    
                // در صورت نیاز می‌توان اطلاعات بیشتر (مثل نوع محاسبه) هم برگرداند
                $options[] = [
                    'title' => $region->title,
                    'cost' => (int) $total,
                    'region_id' => $region->id,
                    'type' => $region->cost_type,
                ];
            }
        }
    
        return $options;
    }
    



}
