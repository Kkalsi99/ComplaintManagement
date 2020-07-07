<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
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
        $validator= validator::make(
            array('phone' =>$phone),
            array('phone' => array('required','numeric','digits:10','unique:users'))
        );
        if ($validator->fails())
    {
        return redirect('/update')->withErrors($validator);
    }
    
        
       
        
        User::where('id',auth()->user()->id)->update(['phone'=>$phone]);
        return redirect()->route('home');

    }
  
}
