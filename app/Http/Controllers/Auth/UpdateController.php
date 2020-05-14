<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;

class UpdateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function updateview(){
        return view('update');
}
    public function update(){
        $phone=request('phone');
        User::where('id',auth()->user()->id)->update(['phone'=>$phone]);
        return redirect()->route('home');

    }
}
