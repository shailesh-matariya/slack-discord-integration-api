<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    public function plans()
    {
        $subscribed = Auth::user()->subscribed();
        $onGracePeriod = Auth::user()->subscriptions()->onGracePeriod()->first();
        return view('plans', compact('subscribed', 'onGracePeriod'));
    }

    public function retrievePlans()
    {
        $key = config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;

        foreach ($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product, []
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
        $stripeCustomer = $user->createOrGetStripeCustomer();
//        dd($stripeCustomer);
        return $user->newSubscription('default', $plan->stripe_id)->checkout($param);
    }

    public function subscribeSuccess(Request $request)
    {
//        return "Subscription success";
//        dd($request->all());
        return redirect('settings');
    }

    public function subscribeFail(Request $request)
    {
//        return "Subscription failed";
//        dd($request->all());
        return redirect('settings');
    }

    public function subscribeCancel(Request $request)
    {
        $subscription = Auth::user()->subscriptions()->active()->notCanceled()->first();
        if ($subscription) {
            $subscription->cancel();
        }
        return redirect()->back();
    }
}
