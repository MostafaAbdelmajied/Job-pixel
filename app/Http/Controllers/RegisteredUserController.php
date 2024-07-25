<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);

        $employerdata = $request->validate([
            'employer'=>'required|string',
            'logo'=>'required|mimes:png,jpg,gif'
        ]);

        $user = User::create($data);
        $logopath = $request->logo->store('logos');
        $employerdata['logo']=$logopath;

        Auth::login($user);
        $employerdata['user_id'] = Auth::user()->id;
        Employer::create([
            'user_id'=>$employerdata['user_id'],
            'name'=>$employerdata['employer'],
            'logo'=>$employerdata['logo']
        ]);
        return redirect('/');
    }
}
