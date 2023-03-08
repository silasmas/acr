<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\Payment as ResourcesPayment;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class PaymentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderByDesc('created_at')->get();

        return $this->handleResponse(ResourcesPayment::collection($payments), __('notifications.find_all_payments_success'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get inputs
        $inputs = [
            'reference' => $request->reference,
            'provider_reference' => $request->provider_reference,
            'order_number' => $request->orderNumber,
            'amount' => $request->amount,
            'amount_customer' => $request->amountCustomer,
            'phone' => $request->phone,
            'currency' => $request->currency,
            'channel' => $request->channel,
            'type_id' => $request->type,
            'status_id' => $request->code,
            'created_at' => $request->createdAt
        ];

        $payment = Payment::create($inputs);

        return $this->handleResponse(new ResourcesPayment($payment), __('notifications.create_payment_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        if (is_null($payment)) {
            return $this->handleError(__('notifications.find_payment_404'));
        }

        return $this->handleResponse(new ResourcesPayment($payment), __('notifications.find_payment_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'reference' => $request->reference,
            'provider_reference' => $request->provider_reference,
            'order_number' => $request->orderNumber,
            'amount' => $request->amount,
            'amount_customer' => $request->amountCustomer,
            'phone' => $request->phone,
            'currency' => $request->currency,
            'channel' => $request->channel,
            'type_id' => $request->type,
            'status_id' => $request->code,
            'updated_at' => now()
        ];

        $payment->update($inputs);

        return $this->handleResponse(new ResourcesPayment($payment), __('notifications.update_payment_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        $payments = Payment::all();

        return $this->handleResponse(ResourcesPayment::collection($payments), __('notifications.delete_payment_success'));
    }
}
