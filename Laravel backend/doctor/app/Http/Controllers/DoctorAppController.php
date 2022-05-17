<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\doctor;
use App\User;
use App\menulist;
use App\specialist;
use App\consultant;
use App\money;
use App\bank;
use App\Notification;
use App\patient;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgotpassword;
class DoctorAppController extends Controller
{
    /**
     * Create a new controller instance.u
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');se
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function doctor_login(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $remember = $request['remember'];
        $fcmToken = $request['fcmToken'];
        $platform = $request['platform'];

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // The user is being remembered...
            //Update online status
            $user = Auth::user();

            $UpdateDetails = User::where('email', $email)->update(['fcmToken' => $fcmToken]);
            $UpdateDetails1 = doctor::where('email', $email)->update(['fcmToken' => $fcmToken]);
            $UpdateDetails2 = doctor::where('email', $email)->update(['call_login' => $platform]);

            $user->save();
            $doctor = doctor::select('id','reader','fname','lname','email','call_id','call_password','call_login','fcmToken','active_state','money','youtube_link','facebook_link','twitter_link','instagram_link','photo', 'remain_chat', 'remain_call', 'remain_video')
                        ->where('email',$user->email)
                        ->first();

            $consultant = consultant::select('consultants.*','patients.name','patients.call_id','patients.call_password','patients.call_login')
                        ->where('doctor_id',$doctor->id)
                        ->leftjoin('patients','patients.id','=','consultants.patient_id')
                        ->get();
            $notifications = Notification::select()->where('receiver_id',$doctor->id)->limit(30)->get();
        //     $rt = array('status' => $notifications);
        // return json_encode($rt);
            $unread_num = Notification::where('receiver_id',$doctor->id)->where('read_state',0)->get()->count();
            $rt = array('status' => 'success','consultant' => $consultant,'doctor' => $doctor,'notifications'=>$notifications,'unread_num'=>$unread_num);
            return json_encode($rt);
        }
        $rt = array('status' => 'failed : login info is not correct');
        return json_encode($rt);
    }
       public function forgotpassword(Request $request)
    {
        $user = User::select()->where('email',$request->email)->get();
        $doctor = doctor::select()->where('approve',1)->where('email',$request->email)->get();
        $patient = patient::select()->where('status','good')->where('email',$request->email)->get();
        if($user->count()> 0 && $doctor->count()> 0){
            Mail::to($request->email)->send(new forgotpassword($user[0]));
            $ndoctor = doctor::select()
                        ->where('approve',1)
                        ->count();
            $nspecialist = specialist::select()->count();
            $menulist = menulist::select()->get();
            $doctor = doctor::select()
                        ->where('approve',1)
                        ->get();
            return view('home')
                    ->with('ndoctor',$ndoctor)
                    ->with('nspecialist',$nspecialist)
                    ->with('menulists',$menulist)
                    ->with('doctors',$doctor)
                    ->with('status','sentemail');
        }
        else if($user->count()> 0 && $patient->count()> 0){
            Mail::to($request->email)->send(new forgotpassword($user[0]));
            $ndoctor = doctor::select()
                        ->where('approve',1)
                        ->count();
            $nspecialist = specialist::select()->count();
            $menulist = menulist::select()->get();
            $doctor = doctor::select()
                        ->where('approve',1)
                        ->get();
            return view('home')
                    ->with('ndoctor',$ndoctor)
                    ->with('nspecialist',$nspecialist)
                    ->with('menulists',$menulist)
                    ->with('doctors',$doctor)
                    ->with('status','sentemail');
        }
        $ndoctor = doctor::select()
                    ->where('approve',1)
                    ->count();
        $nspecialist = specialist::select()->count();
        $menulist = menulist::select()->get();
        $doctor = doctor::select()
                    ->where('approve',1)
                    ->get();
        return view('home')
                ->with('ndoctor',$ndoctor)
                ->with('nspecialist',$nspecialist)
                ->with('menulists',$menulist)
                ->with('doctors',$doctor)
                ->with('status','reemail');
    }
    public function doctor_consultation(Request $request)
    {
        $consultant = consultant::select('consultants.*','patients.name','patients.call_id','patients.call_password','patients.call_login')
                        ->where('doctor_id',$request->doctor_id)
                        ->leftjoin('patients','patients.id','=','consultants.patient_id')
                        ->orderBy('consultants.id', 'desc')
                        ->get();
        $rt = array('status' => 'success','consultant' => $consultant);
        return json_encode($rt);
    }
  public function doctor_sendNotification(Request $request)
    {
        $receiver_id = $request['receiver_id'];
        $sender_id = $request['sender_id'];
        $m_data = $request['value'];

        $consultant1 = consultant::select('consultants.*', 'doctors.fname', 'doctors.lname')
            ->where('patient_id', $receiver_id)
            ->where('doctor_id',$sender_id)
            ->where('consultants.status', 'now')
            ->leftjoin('doctors', 'doctors.id', '=', 'consultants.doctor_id')
            ->first();
         if($consultant1){

         } else {
             $rt = array('status' => 'failed');
             return json_encode($rt);
         }
         $patient = patient::select()->where('id',$receiver_id)->first();
        $date=new \DateTime();
        $sent_time=$date->format("Y-m-d H:i");
        $sender_token = doctor::select('fcmToken')->where('id',$sender_id)->first()->fcmToken;
        $receiver_token = patient::select('fcmToken')->where('id',$receiver_id)->first()->fcmToken;
        $sender_name = User::select('name')->where('fcmToken',$sender_token)->first()->name;
        // $notification = new Notification();
        // $notification->noti_type = $request->noti_type;
        // $notification->receiver_id = $receiver_id;
        // $notification->sender_id = $sender_id;
        // $notification->sent_time =$sent_time;
        // $notification->from_where = 'doctor';
        // $notification->sender_name = $sender_name;
        // $notification->read_state = false;
        // $notification->save();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $title = '';
        $message = '';
        $fields = array();

        if($request->noti_type=='typing'){
            $title = 'ﺣﺼﻠﺖ ﻋﻠﻰ ﺍﺟﺎﺑﺔ ﻣﻦ ﺍﻟﻄﺒﻴﺐ'.(' Dr '.$sender_name.' ');
            $message = 'typing';
        }
        if($request->noti_type=='photo'){
            $title = 'ﺣﺼﻠﺖ ﻋﻠﻰ ﺍﺟﺎﺑﺔ ﻣﻦ ﺍﻟﻄﺒﻴﺐ'.(' Dr '.$sender_name.' ');
            $message = 'typing';
            $m_data = 'Image';
        }
        if($request->noti_type=='voice'){
             $title = '  ﻟﺪﻳﻚ ﻣﻜﺎﻟﻤﺔ ﺻﻮﺗﻴﺔ ﻣﻦ ﺍﻟﻄﺒﻴﺐ '.(' Dr '.$sender_name.' ');
             $message = 'voice';
              $m_data = 'voice';
        }
        if($request->noti_type=='video') {
             $title = ' ﻟﺪﻳﻚ ﻣﻜﺎﻟﻤﺔ ﻓﻴﺪﻳﻮ ﻣﻦ ﺍﻟﻄﺒﻴﺐ'.(' Dr '.$sender_name.' ');
             $message = 'video';
              $m_data = 'video';
        }
        if($patient->call_login == 'ios'){
            $fields = array (
            'registration_ids' =>array($receiver_token),
            'data' => array (
                "msgBody" => $m_data,
                "title"     => $title,
                "message" => $message,
                "action" => $consultant1,
            ),
            'notification' => [
               'title' => $title,
               'body' =>  $m_data,
               'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
           ],
        );
        }
        if($patient->call_login == 'android') {
            $fields = array (
            'registration_ids' =>array($receiver_token),
            'data' => array (
                "msgBody" => $m_data,
                "title"     => $title,
                "message" => $message,
                "action" => $consultant1,
            ),
            'notification'=> null,
        );
        }
        $fields = json_encode ( $fields );
        $headers = array (
            'Authorization: key=AAAAguxeo2E:APA91bFcTC1Q5JG3ClfhMeYyhgRdjYdP-KkEfvwz57sAGkt3yhPBlGcQre7KQFeJ9eYdTiarGrkglN4wzaxyWstsFnS6tY7NT8ZTdGSag8jGW9hnWkyrWolsf_0LQSw0WojWF_PjxVox',
            'Content-Type: application/json'
        );
         $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch );
        $result1=json_decode($result,true);
        if($result1['success']==1){
         return array('success'=>true);
          }
          else{
             return array('success'=>false);
          }
        curl_close ( $ch );

    }
   
    public function doctor_password(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        if($request->current != base64_decode($doctor->password))
        {
            $rt = array('status' => 'failed : current password is not correct');
            return json_encode($rt);
        }
        $doctor->password = base64_encode($request->new);
        $doctor->save();
        $user = User::select()->where('email',$doctor->email)->first();
        $user->password = bcrypt($request->new);
        $user->save();
        $rt = array('status' => 'success');
        return json_encode($rt);
    }
    public function doctor_home(Request $request)
    {
        $doctor = doctor::select('fname','lname','photo','phone','money')->where('id',$request->doctor_id)->first();
        $rt = array('status' => 'success','doctor' => $doctor);
        return json_encode($rt);
    }
     public function get_notification(Request $request)
    {
        $notifications = Notification::select()->where('receiver_id',$request->id)->limit(30)->get();
        $rt = array('status' => 'success','notifications' => $notifications);
        return json_encode($rt);
    }
     public function read_notification(Request $request)
    {
        $notifications = Notification::where('receiver_id',$request->id)->update(['read_state'=>true]);
        $rt = array('status' => 'success','notifications' => $notifications);
        return json_encode($rt);
    }
     public function doctor_online(Request $request)
    {
        $UpdateDetails = doctor::where('id',$request->id)->update(['active_state'=>true]);
        if (is_null($UpdateDetails)) {
            $rt = array('status' => 'failed','message' => 'failure update');
        }
        else{
            $rt = array('status' => 'success','message' => 'successfully updated');
        }
       return json_encode($rt);
    }
    public function doctor_offline(Request $request)
    {
        $UpdateDetails = doctor::where('id',$request->id)->update(['active_state'=>false]);
        if (is_null($UpdateDetails)) {
            $rt = array('status' => 'failed','message' => 'failure update');
        }
        else{
            $rt = array('status' => 'success','message' => 'successfully updated');
        }
       return json_encode($rt);
    }
     public function addbank(Request $request)
    {
        $bank = New bank();
        $bank->number = $request->number;
        $bank->type = $request->type;
        $bank->doctor_id = $request->id;
        $bank->save();
        $rt = array('status' => 'success');
        return json_encode($rt);
    }
    public function doctor_money(Request $request)
    {
        $money = money::select()
                ->where('user_id',$request->doctor_id)
                ->where('type','doctor')
                ->orderBy('id', 'desc')
                ->get();
        $rt = array('status' => 'success','money' => $money);
        return json_encode($rt);
    }
    public function changeprice(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        $doctor->remain_chat = $request->price_chat;
        $doctor->remain_call = $request->price_voice;
        $doctor->remain_video = $request->price_video;
        $doctor->save();
        $rt = array('status' => 'success');
        return json_encode($rt);
    }
    public function doctor_withdraw(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        if(intval($doctor->money) < intval($request->amount))
        {
            $rt = array('status' => "failed : you don't have enough money in account");
            return json_encode($rt);
        }
        \Stripe\Stripe::setApiKey ( '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' );

        $account = \Stripe\Account::create([
            'type' => 'custom',
            'email' => $request->email,
            'requested_capabilities' => [
              'card_payments',
              'transfers',
            ],
        ]);
        try {
            $transfer = \Stripe\Transfer::create([
                'amount' => intval($request->amount)*100,
                'currency' => 'usd',
                'destination' => $account['id']
              ]);
            $money = new money();
            $money->user_id = $request->doctor_id;
            $money->type = 'doctor';
            $money->price = $request->amount;
            $money->save();
            $doctor->money = intval($doctor->money) - intval($request->amount);
            $doctor->save();
            $rt = array('status' => 'success','doctor' => $doctor);
            return json_encode($rt);
        } catch ( \Exception $e )
        {
            $rt = array('status' => "failed : " . $e->getMessage());
            return json_encode($rt);
        }
    }
    public function doctor_history(Request $request)
    {
        $doctor = doctor::select()
            ->where('id',$request->doctor_id)
            ->first();
        $doctors = doctor::select('fname','lname','id')
            ->where('menulist_id',$doctor->menulist_id)
            ->where('id','!=',$doctor->id)
            ->get();
        $rt = array('status' => 'success','doctors' => $doctors);
        return json_encode($rt);
    }
    public function doctor_profile(Request $request)
    {
        $doctor = doctor::select('fname','lname','photo','phone','email','office_address','doctor_cv')
                    ->where('id',$request['doctor_id'])
                    ->first();
        $rt = array('status' => 'success','doctor' => $doctor);
        return json_encode($rt);
    }
    public function doctor_photo_update(Request $request)
    {
        $doctor = doctor::select()
                    ->where('id',$request->doctor_id)
                    ->first();
        // $doctor->fname = $request->fname;
        // $doctor->lname = $request->lname;
        // $old = User::select()->where('email',$request->email)->first();
        // if($doctor->email != $request->email && isset($old))
        // {
        //     $rt = array('status' => 'failed : other user already use email');
        //     return json_encode($rt);
        // }
        // $user = User::select()->where('email',$doctor->email)->first();
        // $doctor->email = $request->email;
        // $user->email = $request->email;
        // $user->name = $request->fname;
        // $user->save();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = rand(100000, 999999).$_FILES["file"]["name"];
            $destinationPath = public_path('../../upload/photo');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $doctor->photo = $name;
        }
        // $doctor->office_address = $request->office_address;
        // $doctor->doctor_cv = $request->doctor_cv;
        $doctor->save();
        $rt = array('status' => 'success','doctor' => $doctor);
        return json_encode($rt);
    }
    public function doctor_profile_update(Request $request)
    {
        $doctor = doctor::select()
                    ->where('id',$request->doctor_id)
                    ->first();
        $doctor->fname = $request->fname;
        $doctor->lname = $request->lname;
        $old = User::select()->where('email',$request->email)->first();
        if($doctor->email != $request->email && isset($old))
        {
            $rt = array('status' => 'failed : other user already use email');
            return json_encode($rt);
        }
        $user = User::select()->where('email',$doctor->email)->first();
        $doctor->email = $request->email;
        $user->email = $request->email;
        $user->name = $request->fname;
        $user->save();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = rand(100000, 999999).$_FILES["file"]["name"];
            $destinationPath = public_path('../../upload/photo');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $doctor->photo = $name;
        }
        $doctor->office_address = $request->office_address;
        $doctor->doctor_cv = $request->doctor_cv;
        $doctor->save();
        $rt = array('status' => 'success','doctor' => $doctor);
        return json_encode($rt);
    }
    public function doctor_attached(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = rand(100000, 999999).$_FILES["file"]["name"];
            $destinationPath = public_path('../../upload/chat');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $rt = array('status' => 'success','name' => $name);
            return json_encode($rt);
        }
        $rt = array('status' => 'failed');
        return json_encode($rt);
    }
}
