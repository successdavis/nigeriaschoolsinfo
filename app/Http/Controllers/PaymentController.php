<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'description'   => 'required|string',
            'module'        => 'required|string',
            'id'            => 'required|integer',
        ]);

        // Check if a class exist and an item for the class
        // Initialize payment for the item
        // And return the payload information to vue for submission to paystack api
        $module = 'App\\' . ucwords(strtolower($request->module));
        if(class_exists($module)) {
            if (!$module::where('id', $request->id)->exists()) {
                abort(400,"Something isn't right!");
            }

            $handler = $module::find($request->id);

            $payment = $handler->initializePayment($request->description);

            return $payment;
        }

        abort(400, "Hmm! You should'nt be seeing this. Please contact admin");
    }

    /**
     * Update an already initialized payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Payment $payment)
    {
        if (!$payment->getPaymentData()) {
            return response("Something went wrong with payment verification", 400);
        }else {
            if ($payment->verifyAmount()) {
                $payment->markSuccessful();
                return response('Payment Verified', 200);
            }else {
                return response("Amount you paid does not corresponds to our transaction record", 400);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
