<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\SaveRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('addresses')->latest()->paginate();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.add');
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
            $user = new User();
            $user->name   = $request->name;
            $user->email   = $request->email;
            $user->email_verified_at = now();
            $user->save();
            if ($user) {
                toastr()->success('', 'User added successfully');
                return redirect()->route('dashboard.users.index');
            }
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
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        try {
            $user->name   = $request->name;
            $user->email   = $request->email;
            $user->save();
            if ($user) {
                toastr()->success('', 'User updated successfully');
                return redirect()->route('dashboard.users.index');
            }
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
    public function destroy(User $user)
    {
        try {
            $user->delete();
            if ($user) {
                toastr()->success('', 'User deleted successfully');
                return redirect()->route('dashboard.users.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
