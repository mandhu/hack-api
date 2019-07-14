<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionAPIController extends AppBaseController
{
    public function subscribe(Request $request)
    {
        return new Subscription($request->all());
    }

    public function userSubscriptions($user_id)
    {
        return Subscription::where('user_id', $user_id)->all();
    }

    public function productSubscriptions($product_id)
    {
        return Subscription::where('product_id', $product_id)->all();
    }
}
