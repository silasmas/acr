<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use App\Models\Area;
use App\Models\Neighborhood;
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
            'number' => $request->number,
            'street' => $request->street,
            'type_id' => $request->type_id,
            'neighborhood_id' => $request->neighborhood_id,
            'area_id' => $request->area_id,
            'user_id' => $request->user_id
        ];
        // Select all addresses of a same neighborhood and a same area to check unique constraint
        $addresses = Address::where([['neighborhood_id', $inputs['neighborhood_id']], ['area_id', $inputs['area_id']]])->get();

        // Validate required fields
        if ($request->neighborhood_id == null OR $request->neighborhood_id == ' ') {
            return $this->handleError($request->neighborhood_id, __('validation.required'), 400);
        }

        if ($request->area_id == null OR $request->area_id == ' ') {
            return $this->handleError($request->area_id, __('validation.required'), 400);
        }

        // Find area and neighborhood by their IDs to get their names
        $area = Area::find($inputs['area_id']);
        $neighborhood = Neighborhood::find($inputs['neighborhood_id']);

        // Check if address already exists
        foreach ($addresses as $another_address):
            if ($another_address->number == $inputs['number'] AND $another_address->street == $inputs['street'] AND $another_address->area_id == $inputs['area_id'] AND $another_address->neighborhood_id == $inputs['neighborhood_id']) {
                return $this->handleError(
                     __('notifications.address.number') . __('notifications.colon_after_word') . ' ' . $request->number . ', ' 
                    . __('notifications.address.street') . __('notifications.colon_after_word') . ' ' . $request->street . ', ' 
                    . __('notifications.address.neighborhood') . __('notifications.colon_after_word') . ' ' . $neighborhood->neighborhood_name . ', ' 
                    . __('notifications.address.area') . __('notifications.colon_after_word') . ' ' . $area->area_name, __('validation.custom.address.exists'), 400);
            }
        endforeach;

        $address = Address::create($inputs);

        return $this->handleResponse(new ResourcesAddress($address), __('notifications.create_address_success'));
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
            'number' => $request->number,
            'street' => $request->street,
            'type_id' => $request->type_id,
            'neighborhood_id' => $request->neighborhood_id,
            'area_id' => $request->area_id,
            'user_id' => $request->user_id,
            'updated_at' => now()
        ];
        // Select all addresses of a same neighborhood and a same area. And select current address to check unique constraint
        $addresses = Address::where([['neighborhood_id', $inputs['neighborhood_id']], ['area_id', $inputs['area_id']]])->get();
        $current_address = Address::find($inputs['id']);

        if ($request->neighborhood_id == null OR $request->neighborhood_id == ' ') {
            return $this->handleError($request->neighborhood_id, __('validation.required'), 400);
        }

        if ($request->area_id == null OR $request->area_id == ' ') {
            return $this->handleError($request->area_id, __('validation.required'), 400);
        }

        // Find area and neighborhood by their IDs to get their names
        $area = Area::find($inputs['area_id']);
        $neighborhood = Neighborhood::find($inputs['neighborhood_id']);

        // Check if address already exists
        foreach ($addresses as $another_address):
            if ($current_address->area_id != $inputs['area_id'] AND $current_address->neighborhood_id != $inputs['neighborhood_id']) {
                if ($another_address->number == $inputs['number'] AND $another_address->street == $inputs['street'] AND $another_address->area_id == $inputs['area_id'] AND $another_address->neighborhood_id == $inputs['neighborhood_id']) {
                    return $this->handleError(
                         __('notifications.address.number') . __('notifications.colon_after_word') . ' ' . $request->number . ', ' 
                        . __('notifications.address.street') . __('notifications.colon_after_word') . ' ' . $request->street . ', ' 
                        . __('notifications.address.neighborhood') . __('notifications.colon_after_word') . ' ' . $neighborhood->neighborhood_name . ', ' 
                        . __('notifications.address.area') . __('notifications.colon_after_word') . ' ' . $area->area_name, __('validation.custom.address.exists'), 400);
                }
            }
        endforeach;

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
