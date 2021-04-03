<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'User'){
            $user=User::orderBy('created_at','desc')->where('id',auth()->user()->id)->orderBy('created_at','desc')->firstOrfail();
        $complaints=$user->complaints;}
        elseif (auth()->user()->role == ''){
            $complaints=Complaint::orderBy('created_at','desc')->orderBy('status')->get();
            }
        else{
            $complaints=Complaint::orderBy('created_at','desc')->where('type',auth()->user()->role)->get();

        }






        return view('home',['complaints' => $complaints]);
    }


}
