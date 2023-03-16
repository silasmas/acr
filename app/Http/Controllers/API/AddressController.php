<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\Address as ResourcesAddress;

/**
 * @author Xanders
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
class AddressController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();

        return $this->handleResponse(ResourcesAddress::collection($addresses), __('notifications.find_all_addresses_success'));
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
            'address_content' => $request->address_content,
            'neighborhood' => $request->neighborhood,
            'area' => $request->area,
            'city' => $request->city,
            'type_id' => $request->type_id,
            'country_id' => $request->country_id,
            'user_id' => $request->user_id
        ];

        // Check if user address already exist
        $user_address = Address::where([['type_id', $inputs['type_id']], ['user_id', $inputs['user_id']]])->first();

        if ($user_address != null) {
            // If address already exists, update it
            $user_address->update([
                'address_content' => $inputs['address_content'],
                'neighborhood' => $inputs['neighborhood'],
                'area' => $inputs['area'],
                'city' => $inputs['city'],
                'country_id' => $inputs['country_id'],
                'updated_at' => now()
            ]);

            return $this->handleResponse(new ResourcesAddress($user_address), __('notifications.update_address_success'));
        }

        if ($user_address == null) {
            $address = Address::create($inputs);

            return $this->handleResponse(new ResourcesAddress($address), __('notifications.create_address_success'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);

        if (is_null($address)) {
            return $this->handleError(__('notifications.find_address_404'));
        }

        return $this->handleResponse(new ResourcesAddress($address), __('notifications.find_address_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        // Get inputs
        $inputs = [
            'id' => $request->id,
            'address_content' => $request->address_content,
            'neighborhood' => $request->neighborhood,
            'area' => $request->area,
            'city' => $request->city,
            'type_id' => $request->type_id,
            'country_id' => $request->country_id,
            'user_id' => $request->user_id,
            'updated_at' => now()
        ];

        if ($inputs['address_content'] != null) {
            $address->update([
                'address_content' => $request->address_content,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['neighborhood'] != null) {
            $address->update([
                'neighborhood' => $request->neighborhood,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['area'] != null) {
            $address->update([
                'area' => $request->area,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['city'] != null) {
            $address->update([
                'city' => $request->city,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['type_id'] != null) {
            $address->update([
                'type_id' => $request->type_id,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['country_id'] != null) {
            $address->update([
                'country_id' => $request->country_id,
                'updated_at' => now(),
            ]);
        }

        if ($inputs['user_id'] != null) {
            $address->update([
                'user_id' => $request->user_id,
                'updated_at' => now(),
            ]);
        }

        $address->update($inputs);

        return $this->handleResponse(new ResourcesAddress($address), __('notifications.update_address_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        $addresses = Address::all();

        return $this->handleResponse(ResourcesAddress::collection($addresses), __('notifications.delete_address_success'));
    }
}
