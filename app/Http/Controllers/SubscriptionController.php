<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    public function retrievePlans() {
        $key = config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;

        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return $plans;
    }

    public function subscribeCheckout(Request $request)
    {
        $user = $request->user();
        $plan = Plans::first();

        $param = [
            'success_url' => route('subscribe.success'),
            'cancel_url' => route('subscribe.fail'),
        ];
//        $user = Cashier::findBillable(config('services.stripe.secret'));
//        dd($user);

        $stripeCustomer = $user->createOrGetStripeCustomer();
//        dd($stripeCustomer);
        return $user->newSubscription('default', $plan->stripe_id)->checkout($param);
        return ;
    }
    public function subscribeSuccess(Request $request)
    {
        dd($request->all());
    }
    public function subscribeFail(Request $request)
    {
        dd($request->all());
    }
}
