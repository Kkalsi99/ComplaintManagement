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
            $user=User::where('id',auth()->user()->id)->firstOrfail();
        $complaints=$user->complaints;}
        elseif (auth()->user()->role == 'Software')
            $complaints=Complaint::where('type','Software')->get();
        else
            $complaints=Complaint::where('type','Hardware')->get();




        return view('home',['complaints' => $complaints]);
    }

}
