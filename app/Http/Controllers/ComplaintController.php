<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\User;
use App\Mail\ComplaintMail;




use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


/**
 * Class ComplaintController
 * @package App\Http\Controllers
 */
class ComplaintController extends Controller

{

    private $complaint;
    private $user;
    /**
     * ComplaintController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->complaint = new Complaint();
        $this->user = new User();

    }

    public function create(){
        return view('complaint');

    }


    /**
     * Sends email
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */



        private function sendRegistered($technician)
    {
        $data=array(
            'technician'=> $technician,
            'complaint'=>$this->complaint
        );
        Mail::to($technician->email)->cc(auth()->user()->email)->send(new ComplaintMail($data));





//         Mail::send('email.mail', [], function ($message) {
//             $message->to('kkalsi95@gmail.com', 'Kashish')->subject('Laravel Basic Testing Mail');
//             $message->cc('sdk26071994@gmail.com', 'SDK')->subject('Laravel Basic Testing Mail');
//         });


    }
    private function sendResolved($user,$complaint)
    {
        $data=array(
            'user'=> $user,
            'complaint'=>$complaint
        );
        Mail::to($user->email)->cc(auth()->user()->email)->send(new ComplaintMail($data));




//         Mail::send('email.mail', [], function ($message) {
//             $message->to('kkalsi95@gmail.com', 'Kashish')->subject('Laravel Basic Testing Mail');
//             $message->cc('sdk26071994@gmail.com', 'SDK')->subject('Laravel Basic Testing Mail');
//         });



    }
    public function store(){


        $this->complaint->location = request('location');
        $this->complaint->type = request('type');
        $this->complaint->body = request('body');
        $this->complaint->user_id = Auth::user()->id;
        $this->complaint->status = 'Processing';


        $this->complaint->save();
        $technician=$this->user->where('role',$this->complaint->type)->first();


        $this->sendRegistered($technician);
        return redirect('/complaint')->with('sent', 'A Email has also been Sent!!');


    }
    public function resolve(){


        $id=request('id');
        $this->complaint->where('id',$id)->update(['status' =>'Resolved' ]);

        $complaint=$this->complaint->where('id',$id)->first();

        $user=$this->user->where('id',$complaint->user_id)->first();

        $this->sendResolved($user,$complaint);

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



