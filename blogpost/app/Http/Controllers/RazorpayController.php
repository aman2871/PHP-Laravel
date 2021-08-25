<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Monolog\SignalHandler;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Session;
use App\Models\User;

class RazorpayController extends Controller
{
    public function razorpay()
    {
        return view('razorpay');
    }
    public function success()
    {
        return view('success');
    }

    public function payment(Request $request)
    {

        $name = $request->input('name');
        $amount = 100;
        $id = Auth::user()->id;
        $api = new Api('rzp_test_owSKbuOvpvfTkd', '8IGtOtbDigz8S6u9sAFxcOjf');
        $order  = $api->order->create(array('receipt' => '123', 'amount' => $amount * 100, 'currency' => 'INR'));
        $orderId = $order['id'];

        $user_pay = new Payment();

        $user_pay->name = $name;
        $user_pay->amount = $amount;
        $user_pay->payment_id = $orderId;
        $user_pay->payment_done = '1';
        $user_pay->save();
        if ($orderId) {

            User::where('id', $id)->update(array('pay_id' => '1'));
        }
        $data = array(
            'order_id' => $orderId,
            'amount' => $amount
        );
        return redirect()->route('home')->with('data', $data);
    }

    public function pay(Request $request)
    {
        $data = $request->all();
        $user = Payment::where('payment_id', $data['razorpay_order_id'])->first();
        $user->payment_done = true;
        $status = $user->payment_done = true;

        $id = Auth::user()->id;

        if ($status) {
            User::where('id', $id)->update(array('pay_id' => '1'));

            $user->razorpay_id = $data['razorpay_payment_id'];

            $api = new Api('rzp_test_CcRYorXwUKnx5y', 'SqHYHxVK94qmGBXwy717KHUl');
            try {
                $attributes = array(
                    'razorpay_signature' => $data['razorpay_signature'],
                    'razorpay_payment_id' => $data['razorpay_payment_id'],
                    'razorpay_order_id' => $data['razorpay_order_id']
                );
                $order = $api->utility->verifyPaymentSignature($attributes);
                $success = true;
            } catch (SignatureVerificationError $e) {

                $succes = false;
            }
            if ($success) {
                $user->save();
                return view('success');
            } else {
                return redirect()->route('razorpay');
            }
        }
    }
}
// rzp_test_owSKbuOvpvfTkd id
// 8IGtOtbDigz8S6u9sAFxcOjf secret