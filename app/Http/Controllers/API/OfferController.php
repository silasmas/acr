<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Resources\Offer as ResourcesOffer;
use App\Models\User;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class OfferController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderByDesc('offer_name')->get();

        return $this->handleResponse(ResourcesOffer::collection($offers), __('notifications.find_all_offers_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get inputs
        $inputs = [
            'offer_name' => $request->offer_name,
            'amount' => $request->amount,
            'type_id' => $request->type_id,
            'user_id' => $request->user_id
        ];

        // Validate required fields
        if ($inputs['type_id'] == null OR $inputs['type_id'] == ' ') {
            return $this->handleError($inputs['type_id'], __('validation.required'), 400);
        }

        if ($inputs['amount'] != null) {
            if ($inputs['user_id'] != null) {
                $current_user = User::find($inputs['user_id']);

                if ($current_user != null) {
                    $data = array(
                        'merchant' => 'ZANDO',
                        'type' => '1',
                        'phone' => $current_user->phone,
                        'reference' => 'MM0000159',
                        'amount' => $inputs['amount'],
                        'currency' => 'CDF', 
                        'callbackUrl' => ''
                    );
                    $data = json_encode($data);
                    $gateway = "http://41.243.7.46:3006/flexpay/api/rest/v1/paymentService";
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $gateway);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        Array(
                            'Content-Type: application/json', 
                            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzI2MTYyMjM0LCJzdWIiOiIyYmIyNjI4YzhkZTQ0ZWZjZjA1ODdmMGRmZjYzMmFjYyJ9.41n-SA4822KKo5aK14rPZv6EnKi9xJVDIMvksHG61nc'
                        )
                    );
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);

                    $response = curl_exec($ch);

                    if (curl_errno($ch)) {
                        return $this->handleError(__('notifications.find_user_404'));
                    
                    } else {
                        curl_close($ch);

                        $jsonRes = json_decode($response);
                        $code = $jsonRes->code;

                        if ($code != "0") {
                            $error_message = 'Impossible de traiter la demande, veuillez réessayer';

                        } else {
                            $message = $jsonRes->message;
                            $orderNumber = $jsonRes->orderNumber;
                        }
                    }

                } else {
                    return $this->handleError(__('notifications.find_user_404'));
                }

            } else {
                # code...
            }
        }

        $offer = Offer::create($inputs);

        return $this->handleResponse(new ResourcesOffer($offer), __('notifications.create_offer_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offer::find($id);

        if (is_null($offer)) {
            return $this->handleError(__('notifications.find_offer_404'));
        }

        return $this->handleResponse(new ResourcesOffer($offer), __('notifications.find_offer_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'offer_name' => $request->offer_name,
            'amount' => $request->amount,
            'type_id' => $request->type_id,
            'user_id' => $request->user_id,
            'updated_at' => now()
        ];

        if ($inputs['type_id'] == null OR $inputs['type_id'] == ' ') {
            return $this->handleError($inputs['type_id'], __('validation.required'), 400);
        }

        if ($inputs['user_id'] == null OR $inputs['user_id'] == ' ') {
            return $this->handleError($inputs['user_id'], __('validation.required'), 400);
        }

        $offer->update($inputs);

        return $this->handleResponse(new ResourcesOffer($offer), __('notifications.update_offer_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        $offers = Offer::all();

        return $this->handleResponse(ResourcesOffer::collection($offers), __('notifications.delete_offer_success'));
    }
}
