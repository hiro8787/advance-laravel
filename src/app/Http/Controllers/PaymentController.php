<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            \Stripe\Charge::create([
            'source' => $request->stripeToken,
            'amount' => 1000,
            'currency' => 'jpy',
        ]);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return back()->with('flash_alert', 'Stripe認証エラー:' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('flash_alert', '決済に失敗しました:' . $e->getMessage());
        }
        return back()->with('status', '決済が完了しました！');
    }
}