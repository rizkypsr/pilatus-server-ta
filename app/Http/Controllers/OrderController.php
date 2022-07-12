<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderByStatus($status)
    {
        $orders = Order::with(['orderItem', 'orderItem.product', 'orderItem.product.category', 'orderItem.product.inventory', 'user', 'payment', 'shipping'])->where('user_id', Auth::user()->id)->where('status', $status)
            ->get();

        return ResponseFormatter::success($orders, "Get All Order Successfull");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['orderItem', 'orderItem.product', 'orderItem.product.category', 'orderItem.product.inventory', 'user', 'payment', 'shipping'])
            ->find($id);

        return ResponseFormatter::success($order, "Get Order Detail Successfull");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkout(Request $request, $id)
    {
        $shipping = Shipping::create([
            'address' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'courier' => $request->courier,
            'service' => $request->service,
            'cost' => $request->cost
        ]);

        $cart = Cart::find($id);
        $cartItems = CartItem::with(['product'])->where('cart_id', $id)->get();
        $item_details = [];

        $order  = Order::create([
            'user_id' => Auth::user()->id,
            'status' => 'PENDING',
            "shipping_id" => $shipping->id,
            'total' => $cart->total + $shipping->cost
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
            ]);

            // array_push($item_details, [
            //     'id' => $item->product->id,
            //     'price' => $item->product->price,
            //     'quantity' => $item->quantity,
            //     'name' => $item->product->name,
            // ]);
        }

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            "transaction_details" => [
                "order_id" => $order->id,
                "gross_amount" => $order->total
            ],
            "customer_details" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ],
            "enabled_payments" => ['bca_va', 'bni_va', 'bri_va'],
            "vtweb" => []
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $order->payment_url = $paymentUrl;
            $order->save();

            return ResponseFormatter::success($order, "Checkout Successfull");
        } catch (Exception $error) {
            return ResponseFormatter::error($error->getMessage(), 'Order Failed');
        }
    }
}
