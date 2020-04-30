<?php

namespace App\Http\Controllers;

use App\Complaint;
use http\Client\Curl\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;
use phpDocumentor\Reflection\DocBlock\Tags\Example;

/**
 * Class ComplaintController
 * @package App\Http\Controllers
 */
class ComplaintController extends Controller

{


    /**
     * ComplaintController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('complaint');

    }


    /**
     * Sends email
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    private function send()
    {


//        Mail::raw("hello", function ($message) {
//            $message->from(Auth::user()->email)->to('foo@example.com')
//                ->subject('Complaint');
//        });
        return redirect('/complaint')->with('sent', 'Email Sent!!');

    }
    public function store(){

        $complaint = new Complaint();
        $complaint->location = request('location');
        $complaint->type = request('type');
        $complaint->body = request('body');
        $complaint->user_id = Auth::user()->id;

        $complaint->save();
//        $this->send();


    }
    public function update(){
        $complaint = new Complaint();
        $id=request('id');
        $complaint->where('id',$id)->update(['status' =>'Done' ]);
        return redirect('/home');

    }

    protected function validateComplaint(){
        return request()->validate([
            'location'=>'required',
            'type'=>'required',
            'body'=>'required'
        ]);
    }

}



