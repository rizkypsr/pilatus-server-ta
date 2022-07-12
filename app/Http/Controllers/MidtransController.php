<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$is3ds = config('services.midtrans.is3ds');

        $notification = new Notification();

        $status = $notification->transaction_status;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;
        $bank = $notification->va_numbers[0]->bank;
        $amount = (int) $notification->gross_amount;

        $order = Order::findOrFail($order_id);

        if ($order->payment_id == null) {
            $payment = Payment::create([
                'provider' => $bank,
                'status' => $status,
                'amount' => $amount,
            ]);
            $order->payment_id = $payment->id;
        } else {

            $payment = Payment::find($order->payment_id);
            $payment->update([
                'status' => $status,
            ]);
        }


        if ($status == 'capture') {
            if ($fraud == 'challenge') {
                $order->status = 'PENDING';
            } else if ($fraud == 'accept') {
                $order->status = 'SUCCESS';
            }
        } else if ($status == 'settlement') {
            $order->status = 'SUCCESS';
        } else if ($status == 'pending') {
            $order->status = 'PENDING';
        } else if ($status == 'expire') {
            $order->status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $order->status = 'CANCELLED';
        } else if ($status == 'deny') {
            $order->status = 'CANCELLED';
        }

        $order->save();
    }
}
