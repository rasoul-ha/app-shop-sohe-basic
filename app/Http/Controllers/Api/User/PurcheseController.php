<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PurcheseController extends Controller
{
    public function __invoke(Request $request)
    {

        try {

            $adminUser = Admin::first();

            $order = new Order();
            $order->products_price = $request->products_price;
            $order->total_price = $request->final_price;
            $order->sku = $this->generateSKU();
            $order->shipping_cost = $request->shippingCost;
            $order->address_id = $request->addressId;
            $order->tax_price = $request->tax_price;
            $order->tax_percent = $request->tax_percent;

            $order->delivery_person_name = $request->deliveryPersonName;
            $order->delivery_person_phone_number = $request->deliveryPersonPhoneNumber;

            $order->additional_note = $request->additional_note;
            $order->payment_method = $request->payment_method;

            $order->user_id = auth()->id();
            $order->save();

            $order->products()->sync($request->items);

            Notification::send($adminUser, new OrderPlaced($order));
           return response()->json(['message' => __('Thank you for your purchase')], 200);

        } catch (Exception $e) {
            Log::error($e->getMessage());
           return response()->json(['message' => __('There was a problem placing the order')], 500);
        }
    }

    protected function generateSKU()
    {
        $number = mt_rand(100000, 999999);
        if ($this->checkSKU($number)) {
            return $this->generateSKU();
        }
        return (string)$number;
    }

    protected function checkSKU($number)
    {
        return Order::where('sku', $number)->exists();
    }
}
