<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class BetaController extends Controller
{
    public function __invoke(Request $request)
    {
        $orderId = $request->post('orderId');
        $amount = $request->post('amount');
        $status = $request->post('status');

        $order = Order::where('id',$orderId )->where('status', Order::WAIT)->first();

        if ($order and $status == 'success'){

            $user = User::where('id', $order->user_id)->first();

            $order->status = Order::FINISH;

            $user->cash = $user->cash + $amount;

            $user->save();

            $order->save();

        }

    }
}