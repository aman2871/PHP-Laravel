<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;

class PaymentController extends Controller
{
    public function index()
    {
        $data = [
            'intent' => auth()->user()->createSetupIntent()
        ];

        return view('payment')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $plan = Plans::where('identifier', $request->plan)
            ->orWhere('identifier', $request->identifire)
            ->first();

        $request->user()->newSubscription('default', $plan->stripe_id)->create($request->token);

        return view('success');
    }
}
