<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\User;
use App\Mail\ComplaintMail;


use http\Env\Request;
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
    public function showComplaints(){
        $complaints=Complaint::orderBy('created_at','desc')->where('category',auth()->user()->role)->get();
        if(sizeof($complaints)){
            $complaints=Complaint::orderBy('created_at','desc')->where('category',auth()->user()->role)->get();



        }
        else
        {$complaints=Complaint::where('type',auth()->user()->role)->get();}
        $size=sizeof($complaints);

        return view('complaintTable',['complaints' => $complaints,'size'=>$size]);
    }
    //Searching
    public function sortComplaints(){



        $id=request('id');
        $type=request('type');
        $UstartDate=request('updated_startDate');
        $location=request('location');

        $UendDate=request('updated_endDate');

        $CstartDate=request('created_startDate');
        $CendDate=request('created_endDate');
        $status=request('status');



        if(Complaint::orderBy('created_at','desc')->where('category',auth()->user()->role)->get()!='NULL'){
            $complaints=Complaint::orderBy('created_at','desc')->where('category',auth()->user()->role)->get();
            dd($complaints);

            }
        else
        {$complaints=Complaint::where('type',auth()->user()->role)->orderBy('created_at','desc')->get();}


        if(isset($location))
            $complaints=Complaint::where('location','LIKE','%'.$location.'%')->get();

//id
        if(isset($id))
            $complaints=$complaints->where('id',$id);
            //type
            if(isset($type))
                $complaints=$complaints->where('type',$type);
            //status
            if(isset($status))
                $complaints=$complaints->where('status',$status);

            //Solved Between
            if(isset($UstartDate)&&isset($UendDate)){
                $UstartDate=$UstartDate.' 00:00:00';
                $UendDate=$UendDate.' 23:59:59';
                $complaints=$complaints->whereIn('status',['Resolved','Unable to resolve']);
                $complaints=$complaints->whereBetween('updated_at',[date($UstartDate),date($UendDate)]);}
            //Solved Before
            if(isset($UendDate)){
                $UstartDate='1999-01-01 00:00:00';
                $UendDate=$UendDate.' 23:59:59';
                $complaints=$complaints->whereIn('status',['Resolved','Unable to resolve']);
                $complaints=$complaints->whereBetween('updated_at',[date($UstartDate),date($UendDate)]);

            }
            //Solved after
            if(isset($UstartDate)){
                $UstartDate=$UstartDate.' 00:00:00';
                $UendDate=date('Y-m-d H:i:s');
                $complaints=$complaints->whereIn('status',['Resolved','Unable to resolve']);
                $complaints=$complaints->whereBetween('updated_at',[date($UstartDate),date($UendDate)]);

            }
            //registered between
            if(isset($CstartDate)&&isset($CendDate)){
                $CstartDate=$CstartDate.' 00:00:00';
                $CendDate=$CendDate.' 23:59:59';
                $complaints=$complaints->whereBetween('created_at',[date($CstartDate),date($CendDate)]);}
            //Registerd Before
            if(isset($CendDate)){
                $CstartDate='1999-01-01 00:00:00';
                $CendDate=$CendDate.' 23:59:59';
                $complaints=$complaints->whereBetween('created_at',[date($CstartDate),date($CendDate)]);

            }
            //Registered after
            if(isset($CstartDate)){
                $CstartDate=$CstartDate.' 00:00:00';
                $CendDate=date('Y-m-d H:i:s');
                $complaints=$complaints->whereBetween('created_at',[date($CstartDate),date($CendDate)]);

            }

//            if(isset($id))
//                $complaints->where('id');

            $size=sizeof($complaints);



        return view('complaintTable',['complaints' => $complaints,'size'=>$size]);
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
    private function sendReason($user,$complaint)
    {
        $data=array(
            'user'=> $user,
            'complaint'=>$complaint
        );




         Mail::send('email.reason', ['data'=>$data], function ($message) {
             $message->to('kkalsi95@gmail.com', 'Kashish')->subject('Regarding Complaint');

         });



    }
    public function store(){


        $this->complaint->location = request('location');
        $this->complaint->category = request('category');
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
    public function reason(){
        $id=request('id');
        $reason=request('reason');

        $this->complaint->where('id',$id)->update(['reason_for_not_resolvable' =>$reason ,'status'=>'Unable to resolve']);

        $complaint=$this->complaint->where('id',$id)->first();

        $user=$this->user->where('id',$complaint->user_id)->first();

        $this->sendReason($user,$complaint);

        return redirect('/home');
    }

    protected function validateComplaint(){
        return request()->validate([
            'location'=>'required',
            'type'=>'required',
            'category'=>'required',
            'body'=>'required'
        ]);
    }

}



