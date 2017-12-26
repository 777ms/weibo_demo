<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\User;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);
       if(Auth::attempt($credentials, $request->has('remember'))){
           //dengluchenggong
           session()->flash('success','welcome back');
           return redirect()->route('users.show',[Auth::user()]);
       }
       else {
           //denglushibai
           session()->flash('danger','your email or password is wrong');
           return redirect()->back();
       }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success','logout !');
        return redirect('login');
    }
}
