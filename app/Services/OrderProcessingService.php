<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderProcessingService
{
    /**
     * Process the order after it is created.
     *
     * @param Order $order
     * @return void
     */
    public function process(Order $order)
    {
        Log::info('Processing order', ['order_id' => $order->id]);

        // مثال: بررسی وضعیت سفارش
        if ($order->status === 'pending') {
            $this->updateInventory($order);
            $this->applyDiscounts($order);
            $this->calculateShipping($order);
            $this->sendOrderConfirmation($order);
        }
    }

    /**
     * Update the inventory based on the order items.
     *
     * @param Order $order
     * @return void
     */
    private function updateInventory(Order $order)
    {
        foreach ($order->orderItems as $item) {
            $product = $item->product;
            if ($product && $product->stock >= $item->quantity) {
                $product->decrement('stock', $item->quantity);
                Log::info('Inventory updated', ['product_id' => $product->id, 'quantity' => $item->quantity]);
            } else {
                Log::warning('Insufficient stock for product', ['product_id' => $product->id]);
            }
        }
    }

    /**
     * Apply any applicable discounts to the order.
     *
     * @param Order $order
     * @return void
     */
    private function applyDiscounts(Order $order)
    {
        $discountCode = $order->discountCode;

        if ($discountCode) {
            // محاسبه و اعمال تخفیف
            $discountAmount = $this->calculateDiscount($order, $discountCode);
            $order->update(['discount_amount' => $discountAmount]);

            Log::info('Discount applied', ['order_id' => $order->id, 'discount_amount' => $discountAmount]);
        }
    }

    /**
     * Calculate the discount based on the discount code.
     *
     * @param Order $order
     * @param $discountCode
     * @return float
     */
    private function calculateDiscount(Order $order, $discountCode)
    {
        $total = $order->total;
        $discountAmount = 0;

        switch ($discountCode->type) {
            case 'percentage':
                $discountAmount = $total * ($discountCode->value / 100);
                break;
            case 'fixed':
                $discountAmount = $discountCode->value;
                break;
        }

        return min($discountAmount, $total); // جلوگیری از اعمال تخفیف بیش از کل
    }

    /**
     * Calculate and update shipping costs.
     *
     * @param Order $order
     * @return void
     */
    private function calculateShipping(Order $order)
    {
        $shippingCost = 0;

        if ($order->deliveryType === 'home_delivery') {
            $shippingCost = 50000; // مثال: هزینه ثابت ارسال
        }

        $order->update(['shipping_price' => $shippingCost]);

        Log::info('Shipping cost calculated', ['order_id' => $order->id, 'shipping_price' => $shippingCost]);
    }

    /**
     * Send an order confirmation email.
     *
     * @param Order $order
     * @return void
     */
    private function sendOrderConfirmation(Order $order)
    {
        // ارسال ایمیل یا اعلان برای تایید سفارش
        Log::info('Order confirmation sent', ['order_id' => $order->id]);
    }
}
