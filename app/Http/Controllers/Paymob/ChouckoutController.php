<?php

namespace App\Http\Controllers\Paymob;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PayMobGatway;
use Illuminate\Http\Request;

class ChouckoutController extends Controller
{
    public function index( PayMobGatway $payMobGatway){
        $order = Order::create([
        "total_price" => '1050',
        ]);

        $PaymentKey = $payMobGatway->pay($order->total_price,$order->id);
        return view('paymob')->with(['token'=>$PaymentKey]);
    }

    //update data

    public function update(Request $request,PayMobGatway $payMob){

        $payMob->checkout_processed($request);
    }


    // return to view after payment

    public function backView(Request $request){

        return $request->all();
         $status ='';
        if($request->success == 'true' ){
            $status = " The Payment is success";
        }
        return view('welcome',compact('status'));
    }

}
