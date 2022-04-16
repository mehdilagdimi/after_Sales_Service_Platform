<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        // $this->middleware(['admin']);   
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
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->validate($request, [
            'ticket_id' => 'required'
        ]);
    
        //if admin
        if(Auth::user()->role == "admin"){ 
            $admin = Auth::user();   
            $userToBeDeleted = User::find($request->user_id);
            Auth::setUser($userToBeDeleted);
            Auth::logout();
            $res = $userToBeDeleted->delete();
            Auth::setUser($admin);

            session()->flash('User delete status', $res);
            return redirect()->route('dashboard');
        } else {
            $user = User::find(Auth::user()->id);
            Auth::logout();
            if ($user->delete()) {

                return redirect()->route('auth')->with('global', 'Your account has been deleted!');
           }
        }
      
    }
}
