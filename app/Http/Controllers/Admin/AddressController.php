<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Address\SaveRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $addresses = $user->addresses;
        return view('dashboard.users.list-addresses',compact('user','addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('dashboard.users.add-address', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRequest $request, User $user)
    {
        try {
            $user->addresses()->create([
                'street_name' => $request->street_name,
                'city' => $request->city,
                'state' => $request->state,
                "zip_code"=> $request->zip_code

            ]);
            toastr()->success('', 'Address added successfully');
            return redirect()->route('dashboard.users.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,Address $address)
    {
        return view('dashboard.users.edit-address',compact('address','user'));
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
            $address->street_name = $request->street_name;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->zip_code = $request->zip_code;
            $address->save();
            toastr()->success('', 'The address has been successfully updated');
            return redirect()->route('dashboard.users.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
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
            if ($address) {
                toastr()->success('', 'Address deleted successfully');
                return redirect()->route('dashboard.users.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
