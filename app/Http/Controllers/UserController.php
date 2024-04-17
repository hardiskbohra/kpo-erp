<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
       $users = User::with('role')->get();
       return view('user.list_copy', compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = \App\Models\Role::select('id','name')->get();
        return view('user.edit',compact(['user','roles']));
    }

    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('user.edit', compact('user'));
    // }
    // public function update($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->update($request->validated());
    // }
    public function update(Request $request, User $user)
    {
        $user->update($request->only('name','email','role_id'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

}
// https://www.itsolutionstuff.com/post/laravel-8-crud-application-tutorial-for-beginnersexample.html
