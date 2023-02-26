<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\SaveRequest;
use App\Http\Resources\User\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $addresses = auth()->user()->addresses;
            return response()->json([
                'addresses' => AddressResource::collection($addresses)
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRequest $request)
    {
        try {

            $address = new Address();
            $address->user_id = auth()->id();
            $address->street_name = $request->street_name;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->zip_code = $request->zip_code;
            $address->save();

            return response()->json([
                'message' => __("Address added successfully")
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRequest $request, Address $address)
    {
        try {
            $address->user_id = auth()->id();
            $address->street_name = $request->street_name;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->zip_code = $request->zip_code;
            $address->save();

            return response()->json([
                'message' => __(' The address has been updated successfully')
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        try {
            $address->delete();
            return response()->json([
                'message' => __('Address removed successfully')
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
