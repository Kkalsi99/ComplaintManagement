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

    private $complaint;
    /**
     * ComplaintController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->complaint = new Complaint();
    }

    public function create(){
        return view('complaint');

    }


    /**
     * Sends email
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    private function send($id)
    {
        dd(\request());

//        Mail::raw("hello", function ($message) {
//            $message->to('kkalsi95@gmail.com')
//                ->subject('Complaint');
//        });
//        return redirect('/complaint')->with('sent', 'Email Sent!!');

    }
    public function store(){


        $this->complaint->location = request('location');
        $this->complaint->type = request('type');
        $this->complaint->body = request('body');
        $this->complaint->user_id = Auth::user()->id;

        $this->complaint->save();
        $this->send();


    }
    public function update(){


        $id=request('id');
        $this->complaint->where('id',$id)->update(['status' =>'Resolved' ]);
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



