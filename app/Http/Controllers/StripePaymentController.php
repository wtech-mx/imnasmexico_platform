<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('user.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        $stripe = Stripe\Charge::create ([
                "amount" => 600 * 100,
                "currency" => "MXN",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);


        Session::flash('success', 'Payment successful!');

        return back();
    }
}
