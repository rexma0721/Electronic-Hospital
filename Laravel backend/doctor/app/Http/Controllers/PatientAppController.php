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
use App\contact;
use App\patient;
use App\Notification;
use App\country;

use Illuminate\Support\Facades\Mail;
use App\Mail\forgotpassword;

use Twilio\Jwt\ClientToken;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PatientAppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function patient_login(Request $request)
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
            $UpdateDetails1 = patient::where('email', $email)->update(['fcmToken' => $fcmToken]);
            $UpdateDetails2 = patient::where('email', $email)->update(['call_login' => $platform]);
            $user->save();
            $menulist = menulist::select()
                ->get();
            $countrylist = country::select()->get();
            $doctor = doctor::select('menulists.text', 'doctors.photo', 'doctors.fname', 'doctors.lname', 'doctors.call_id', 'doctors.id', 'doctors.menulist_id', 'doctors.fcmToken', 'doctors.active_state', 'degrees.text as degree', 'specialists.text as specialization', 'doctors.doctor_cv', 'doctors.pcode', 'doctors.experience', 'doctors.authorization_no', 'doctors.country_id', 'doctors.remain_chat', 'doctors.remain_call', 'doctors.remain_video')
                ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
                ->leftjoin('degrees', 'degrees.id', '=', 'doctors.degree_id')
                ->leftjoin('specialists', 'specialists.id', '=', 'doctors.specialist1_id')
                ->orderBy('doctors.menulist_id')
                ->where('doctors.approve', 1)
                ->get();
            $newmenulist = array();
            foreach ($menulist as $menulistone) {
                $i = 0;
                foreach ($doctor as $doctorone) {
                    if ($menulistone->id == $doctorone->menulist_id && $i == 0) {
                        $i++;
                        array_push($newmenulist, array("id" => $menulistone->id, "text" => $menulistone->text,
                            "price_chat" => $menulistone->price_chat, "price_voice" => $menulistone->price_voice, "price_video" => $menulistone->price_video));
                    }
                }
            }
            $patient = patient::select()
                ->where('email', $request->email)
                ->first();
            $rt = array('status' => 'success', 'menulist' => $newmenulist, 'doctor' => $doctor, 'patient' => $patient, 'countrylist' => $countrylist);
            return json_encode($rt);
        }
        $rt = array('status' => 'failed : login info is not correct');
        return json_encode($rt);
    }
    public function patient_login_social(Request $request)
    {
        $email = $request['email'];
        $name = $request['name'];
        $remember = $request['remember'];
        $fcmToken = $request['fcmToken'];
        $platform = $request['platform'];

        $menulist = menulist::select()
                ->get();
            $countrylist = country::select()->get();
            $doctor = doctor::select('menulists.text', 'doctors.photo', 'doctors.fname', 'doctors.lname', 'doctors.call_id', 'doctors.id', 'doctors.menulist_id', 'doctors.fcmToken', 'doctors.active_state', 'degrees.text as degree', 'specialists.text as specialization', 'doctors.doctor_cv', 'doctors.pcode', 'doctors.experience', 'doctors.authorization_no', 'doctors.country_id', 'doctors.remain_chat', 'doctors.remain_call', 'doctors.remain_video')
                ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
                ->leftjoin('degrees', 'degrees.id', '=', 'doctors.degree_id')
                ->leftjoin('specialists', 'specialists.id', '=', 'doctors.specialist1_id')
                ->orderBy('doctors.menulist_id')
                ->where('doctors.approve', 1)
                ->get();
            $newmenulist = array();
            foreach ($menulist as $menulistone) {
                $i = 0;
                foreach ($doctor as $doctorone) {
                    if ($menulistone->id == $doctorone->menulist_id && $i == 0) {
                        $i++;
                        array_push($newmenulist, array("id" => $menulistone->id, "text" => $menulistone->text,
                            "price_chat" => $menulistone->price_chat, "price_voice" => $menulistone->price_voice, "price_video" => $menulistone->price_video));
                    }
                }
            }

        $old = User::select()->where('email', $request->email)->first();
        if (isset($old)) {
            $UpdateDetails = User::where('email', $email)->update(['fcmToken' => $fcmToken]);
            $UpdateDetails1 = patient::where('email', $email)->update(['fcmToken' => $fcmToken]);
            $UpdateDetails2 = patient::where('email', $email)->update(['call_login' => $platform]);

            $patient = patient::select()
                ->where('email', $request->email)
                ->first();
            $rt = array('status' => 'success', 'menulist' => $newmenulist, 'doctor' => $doctor, 'patient' => $patient, 'countrylist' => $countrylist);
            return json_encode($rt);
        } else{
            $patient = new patient();
            $patient->name = $request->name;
            $patient->phone = 'null';
            $patient->email = $request->email;
            $patient->username = $request->name;
            $patient->sex = 1;
            $patient->password = base64_encode('');
            $patient->status = 'good';
            $patient->call_login = 'sdf';
            $patient->call_password = 'sdf';
            $patient->call_id = '11';
            $patient->fcmToken = $fcmToken; 
            $patient->save();
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = bcrypt('');
            $user->save();
            $patient = patient::select()
            ->where('email', $request->email)
            ->first();
            $rt = array('status' => 'success', 'menulist' => $newmenulist, 'doctor' => $doctor, 'patient' => $patient);
            return json_encode($rt);
        }
        $rt = array('status' => 'failed : login info is not correct');
        return json_encode($rt);

    }
    public function patientgetlist(Request $request)
    {
            $menulist = menulist::select()
                ->get();
            $countrylist = country::select()->get();
            $doctor = doctor::select('menulists.text', 'doctors.photo', 'doctors.fname', 'doctors.lname', 'doctors.call_id', 'doctors.id', 'doctors.menulist_id', 'doctors.fcmToken', 'doctors.active_state', 'degrees.text as degree', 'specialists.text as specialization', 'doctors.doctor_cv', 'doctors.pcode', 'doctors.experience', 'doctors.authorization_no', 'doctors.country_id', 'doctors.remain_chat', 'doctors.remain_call', 'doctors.remain_video')
                ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
                ->leftjoin('degrees', 'degrees.id', '=', 'doctors.degree_id')
                ->leftjoin('specialists', 'specialists.id', '=', 'doctors.specialist1_id')
                ->orderBy('doctors.menulist_id')
                ->where('doctors.approve', 1)
                ->get();
            $newmenulist = array();
            foreach ($menulist as $menulistone) {
                $i = 0;
                foreach ($doctor as $doctorone) {
                    if ($menulistone->id == $doctorone->menulist_id && $i == 0) {
                        $i++;
                        array_push($newmenulist, array("id" => $menulistone->id, "text" => $menulistone->text,
                            "price_chat" => $menulistone->price_chat, "price_voice" => $menulistone->price_voice, "price_video" => $menulistone->price_video));
                    }
                }
            }
            $rt = array('status' => 'success', 'menulist' => $newmenulist, 'patient' => null,'doctor' => $doctor, 'countrylist' => $countrylist);
            return json_encode($rt);
     
    }

    public function patient_verify(Request $request)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        try {
            $client = new Client(['auth' => [$accountSid, $authToken]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/' . $accountSid . '/Messages.json',
                [
                    'form_params' => [
                        'Body' => 'IRAQ Doctor Consultant Verification CODE: ' . $request->verify_code, //set message body
                        'To' => $request->phonenumber,
                        'From' => '+19166194425' //we get this number from twilio
                    ]]);
            $rt = array('status' => 'success');
            return json_encode($rt);
        } catch (Exception $e) {
            $rt = array('status' => "failed : " . $e->getMessage());
            return json_encode($rt);
        }
    }

    public function patient_sendNotification(Request $request)
    {
        $receiver_id = $request['receiver_id'];
        $sender_id = $request['sender_id'];
        $m_data = $request['value'];

        $consultant = consultant::select('consultants.*','patients.name','patients.call_id','patients.call_password','patients.call_login')
            ->where('patient_id', $sender_id)
            ->where('doctor_id',$receiver_id)
            ->where('consultants.status', 'now')
            ->leftjoin('patients','patients.id','=','consultants.patient_id')
            ->first();
//        file_put_contents("a.txt", var_dump($request));
//        if ($consultantc) {
//            $rt = array('status' => 'failed');
//            return json_encode($rt);
//        }
       if(!$consultant){
           $rt = array('status' => 'failed');
           return json_encode($rt);
       }
        $doctor = doctor::select()->where('id', $receiver_id)->first();

        $date = new \DateTime();
        $sent_time = $date->format("Y-m-d H:i");
        $sender_token = patient::select('fcmToken')->where('id', $sender_id)->first()->fcmToken;
        $receiver_token = doctor::select('fcmToken')->where('id', $receiver_id)->first()->fcmToken;
        $sender_name = User::select('name')->where('fcmToken', $sender_token)->first()->name;
        $notification = new Notification();
        $notification->noti_type = $request->noti_type;
        $notification->receiver_id = $receiver_id;
        $notification->sender_id = $sender_id;
        $notification->sent_time = $sent_time;
        $notification->from_where = 'patient';
        $notification->sender_name = $sender_name;
        $notification->read_state = false;
        $notification->save();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $title = '';
        $message = '';
        $fields = array();
        if ($request->noti_type == 'typing') {
            $title ='ﺣﺼﻠﺖ ﻋﻠﻰ ﺳﺆﺍﻝ ﻣﻦ '.(' '.$sender_name.' ');
            $message = '';
        } else if ($request->noti_type == 'voice') {
            $title =' ﺗﻢ ﺍﺳﺘﻼﻡ ﻣﻠﻒ ﻣﻦ'.(' '.$sender_name.' ');
            $message = 'Hi, Can we have voice call?';
        } else {
             $title =' ﺗﻢ ﺍﺳﺘﻼﻡ ﻣﻠﻒ ﻣﻦ'.(' '.$sender_name.' ');
            $message = 'Dear, Can we have video call?';
        }

        if($doctor->call_login == 'ios' ){
        	 $fields = array(
            'registration_ids' => array($receiver_token),
            'data' => array(
                "msgBody" => $m_data,
                "title" => $title,
                "message" => $message,
                "action" => $consultant,
            ),
           'notification' => [
               'title' =>  $m_data,
               'body' => $title,
               'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
           ],

        	);
        } if($doctor->call_login == 'android' ){
        	$fields = array(
            'registration_ids' => array($receiver_token),
            'data' => array(
                "msgBody" => $m_data,
                "title" => $title,
                "message" => $message,
                "action" => $consultant,
            ),
//            'notification' => [
//                'title' => $request['noti_type'],
//                'body' => $sender_name,
//                'icon' => 'https://tecnicocerca.com/public/images/logo.png',
//            ],
            'notification' => null,

        );
        }
       
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=AAAAguxeo2E:APA91bFcTC1Q5JG3ClfhMeYyhgRdjYdP-KkEfvwz57sAGkt3yhPBlGcQre7KQFeJ9eYdTiarGrkglN4wzaxyWstsFnS6tY7NT8ZTdGSag8jGW9hnWkyrWolsf_0LQSw0WojWF_PjxVox',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        $result1 = json_decode($result, true);
        if ($result1['success'] == 1) {
            return array('success' => true);
        } else {
            return array('success' => false);
        }
        curl_close($ch);

    }

    public function patient_register(Request $request)
    {
        $old = User::select()->where('email', $request->email)->first();
        if (isset($old)) {
            $rt = array('status' => 'failed : other user already use email');
            return json_encode($rt);
        }
        $patient = new patient();
        $patient->name = $request->name;
        $patient->phone = 'null';
        $patient->email = $request->email;
        $patient->username = $request->name;
        $patient->sex = 1;
        $patient->password = base64_encode($request->password);
        $patient->status = 'good';
        $patient->call_login = 'sdf';
        $patient->call_password = 'sdf';
        $patient->call_id = '11';
        $patient->save();
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        $menulist = menulist::select()
            ->get();
        $doctor = doctor::select('menulists.text', 'doctors.photo', 'doctors.fname', 'doctors.lname', 'doctors.call_id', 'doctors.id', 'doctors.menulist_id')
            ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
            ->orderBy('doctors.menulist_id')
            ->where('doctors.approve', 1)
            ->get();
        $newmenulist = array();
        foreach ($menulist as $menulistone) {
            $i = 0;
            foreach ($doctor as $doctorone) {
                if ($menulistone->id == $doctorone->menulist_id && $i == 0) {
                    $i++;
                    array_push($newmenulist, array("id" => $menulistone->id, "text" => $menulistone->text,
                        "price_chat" => $menulistone->price_chat, "price_voice" => $menulistone->price_voice, "price_video" => $menulistone->price_video));
                }
            }
        }
        $patient = patient::select()
            ->where('email', $request->email)
            ->first();
        $rt = array('status' => 'success', 'menulist' => $newmenulist, 'doctor' => $doctor, 'patient' => $patient);
        return json_encode($rt);
    }

    public function patient_menulist(Request $request)
    {
        $doctor = doctor::select('menulists.text', 'specialists.text as stext', 'degrees.text as degree', 'doctors.experience', 'doctors.authorization_no', 'doctors.photo', 'doctors.id', 'doctors.menulist_id', 'doctors.fname', 'doctors.lname', 'doctors.service_chat', 'doctors.service_call', 'doctors.service_video', 'doctors.doctor_cv', 'doctors.pcode', 'doctors.active_state', 'doctors.country_id', 'doctors.remain_chat', 'doctors.remain_call', 'doctors.remain_video')
            ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
            ->leftjoin('specialists', 'specialists.id', '=', 'doctors.specialist1_id')
            ->leftjoin('degrees', 'degrees.id', '=', 'doctors.degree_id')
            ->where('doctors.menulist_id', $request->menulist_id)
            ->where('doctors.approve', 1)
            ->get();
        $consultant = array();
        foreach ($doctor as $doctorone) {
            $consultantone = consultant::select()
                ->where('doctor_id', $doctorone->id)
                ->where('status', 'old')
                ->get();
            $i = 0;
            $f = 0;
            $sum = 0;
            foreach ($consultantone as $consultantone1) {
                $i++;
                $sum += intval($consultantone1->rate);
                if (intval($consultantone1->rate) > 2) {
                    $f++;
                }
            }
            if ($i != 0) {
                array_push($consultant, array("id" => $doctorone->id, "text" => $doctorone->text, "stext" => $doctorone->stext, "photo" => $doctorone->photo, "fname" => $doctorone->fname, "lname" => $doctorone->lname, "service_chat" => $doctorone->service_chat, "service_call" => $doctorone->service_call, "service_video" => $doctorone->service_video
                , "rate" => $sum / $i, "questioned" => $i, "satisfied" => $f / $i * 100, "authorization_no" => $doctorone->authorization_no, "degree" => $doctorone->degree, "experience" => $doctorone->experience, "active_state" => $doctorone->active_state, "pcode" => $doctorone->pcode));
            } else {
                array_push($consultant, array("id" => $doctorone->id, "text" => $doctorone->text, "stext" => $doctorone->stext, "photo" => $doctorone->photo, "fname" => $doctorone->fname, "lname" => $doctorone->lname, "service_chat" => $doctorone->service_chat, "service_call" => $doctorone->service_call, "service_video" => $doctorone->service_video
                , "rate" => 'yet', "questioned" => 0, "satisfied" => 'yet', "authorization_no" => $doctorone->authorization_no, "degree" => $doctorone->degree, "experience" => $doctorone->experience, "active_state" => $doctorone->active_state, "pcode" => $doctorone->pcode));
            }
        }
        $rt = array('status' => 'success', 'doctor' => $consultant);
        return json_encode($rt);
    }

    public function patient_photo_update(Request $request)
    {
        $patient = patient::select()
            ->where('id', $request->patient_id)
            ->first();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = rand(100000, 999999) . $_FILES["file"]["name"];
            $destinationPath = public_path('../../upload/photo');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $patient->photo = $name;
        }
        $patient->save();
        $rt = array('status' => 'success', 'patient' => $patient);
        return json_encode($rt);
    }

    public function patient_doctor(Request $request)
    {
        $doctor = doctor::select('menulists.text', 'menulists.price_chat', 'menulists.price_voice', 'menulists.price_video', 'specialists.text as stext', 'doctors.photo', 'doctors.id', 'doctors.menulist_id', 'doctors.fname', 'doctors.lname', 'doctors.doctor_cv', 'doctors.video_link', 'doctors.service_chat', 'doctors.service_call', 'doctors.service_video', 'doctors.pcode', 'doctors.experience', 'doctors.authorization_no')
            ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
            ->leftjoin('specialists', 'specialists.id', '=', 'doctors.specialist1_id')
            ->where('doctors.id', $request->doctor_id)
            ->where('doctors.approve', 1)
            ->first();
        $consultantone = consultant::select()
            ->where('doctor_id', $doctor->id)
            ->where('status', 'old')
            ->get();
        $i = 0;
        $f = 0;
        $sum = 0;
        foreach ($consultantone as $consultantone1) {
            $i++;
            $sum += intval($consultantone1->rate);
            if (intval($consultantone1->rate) > 2) {
                $f++;
            }
        }
        if ($i != 0) {
            $consultant = array("id" => $doctor->id, "menulist_id" => $doctor->menulist_id, "text" => $doctor->text, "stext" => $doctor->stext, "photo" => $doctor->photo, "fname" => $doctor->fname, "lname" => $doctor->lname,
                "service_chat" => $doctor->service_chat, "service_call" => $doctor->service_call, "service_video" => $doctor->service_video,
                "price_chat" => $doctor->price_chat, "price_video" => $doctor->price_video, "price_voice" => $doctor->price_voice,
                "doctor_cv" => $doctor->doctor_cv, "video_link" => $doctor->video_link
            , "rate" => $sum / $i, "questioned" => $i, "satisfied" => $f / $i * 100);
        } else {
            $consultant = array("id" => $doctor->id, "menulist_id" => $doctor->menulist_id, "text" => $doctor->text, "stext" => $doctor->stext, "photo" => $doctor->photo, "fname" => $doctor->fname, "lname" => $doctor->lname,
                "service_chat" => $doctor->service_chat, "service_call" => $doctor->service_call, "service_video" => $doctor->service_video,
                "price_chat" => $doctor->price_chat, "price_video" => $doctor->price_video, "price_voice" => $doctor->price_voice
            , "doctor_cv" => $doctor->doctor_cv, "video_link" => $doctor->video_link
            , "rate" => 'yet', "questioned" => 0, "satisfied" => 'yet');
        }
        $rt = array('status' => 'success', 'doctor' => $consultant);
        return json_encode($rt);
    }

    public function patient_password(Request $request)
    {
        $patient = patient::select()->where('id', $request->patient_id)->first();
        if ($request->current != base64_decode($patient->password)) {
            $rt = array('status' => 'failed : current password is not correct');
            return json_encode($rt);
        }
        $patient->password = base64_encode($request->new);
        $patient->save();
        $user = User::select()->where('email', $patient->email)->first();
        $user->password = bcrypt($request->new);
        $user->save();
        $rt = array('status' => 'status');
        return json_encode($rt);
    }

    public function patient_money(Request $request)
    {
        $money = money::select()
            ->where('user_id', $request->patient_id)
            ->where('type', 'patient')
            ->orderBy('id', 'desc')
            ->get();
        $rt = array('status' => 'success', 'money' => $money);
        return json_encode($rt);
    }

    public function patient_consultation(Request $request)
    {
        $consultant = consultant::select('consultants.*', 'doctors.fname', 'doctors.lname')
            ->where('patient_id', $request->patient_id)
            ->leftjoin('doctors', 'doctors.id', '=', 'consultants.doctor_id')
            ->orderBy('consultants.id', 'desc')
            ->get();
        $rt = array('status' => 'success', 'consultant' => $consultant);
        return json_encode($rt);
    }

    public function patient_alldoctors(Request $request)
    {
        $menulist = menulist::select()
            ->get();
        $doctor = doctor::select('menulists.text', 'doctors.photo', 'doctors.id', 'doctors.menulist_id')
            ->leftjoin('menulists', 'menulists.id', '=', 'doctors.menulist_id')
            ->orderBy('doctors.menulist_id')
            ->where('doctors.approve', 1)
            ->get();
        $rt = array('status' => 'success', 'menulist' => $menulist, 'doctor' => $doctor);
        return json_encode($rt);
    }
    public function contactus(Request $request)
    {
        $contact = New contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone_number;
        $contact->email = $request->email;
        $contact->text = $request->message;
        $contact->save();
        $rt = array('status' => 'success');
        return json_encode($rt);
    }

    public function patient_home(Request $request)
    {
        $patient = patient::select('name', 'photo', 'phone', 'money')->where('id', $request->patient_id)->first();
        $rt = array('status' => 'success', 'patient' => $patient);
        return json_encode($rt);
    }

    public function patient_profile(Request $request)
    {
        $patient = patient::select('name', 'photo', 'phone', 'email', 'address', 'more_info')
            ->where('id', $request->patient_id)
            ->first();
        $rt = array('status' => 'success', 'patient' => $patient);
        return json_encode($rt);
    }

    public function patient_profile_update(Request $request)
    {
        $patient = patient::select()
            ->where('id', $request->patient_id)
            ->first();
        $patient->name = $request->name;
        $old = User::select()->where('email', $request->email)->first();
        if ($patient->email != $request->email && isset($old)) {
            $rt = array('status' => 'failed : other user already use email');
            return json_encode($rt);
        }
        $user = User::select()->where('email', $patient->email)->first();
        $patient->email = $request->email;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = rand(100000, 999999) . $_FILES["file"]["name"];
            $destinationPath = public_path('../../upload/avata');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $patient->photo = $name;
        }
        $patient->address = $request->address;
        $patient->more_info = $request->more_info;
        $patient->save();
        $rt = array('status' => 'success', 'patient' => $patient);
        return json_encode($rt);
    }

    public function patient_addmoney(Request $request)
    {
        try {
        \Stripe\Stripe::setApiKey('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');
        $stripeToken =
            \Stripe\Token::create([
                'card' => [
                    'number' => $request->cardnumber,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);
            \Stripe\Charge::create(array(
                "amount" => intval($request->amount) * 100,
                "currency" => "usd",
                "source" => $stripeToken, // obtained with Stripe.js
                "description" => "Add Money to account."
            ));
            $money = new money();
            $money->user_id = $request->patient_id;
            $money->type = 'patient';
            $money->price = $request->amount;
            $money->save();
            $patient = patient::select()
                ->where('id', $request->patient_id)
                ->first();
            $patient->money = intval($patient->money) + intval($request->amount);
            $patient->save();
            $rt = array('status' => 'success', 'patient' => $patient);
            return json_encode($rt);
        } catch (\Exception $e) {
            $rt = array('status' => "failed : " . $e->getMessage());
            return json_encode($rt);
        }
    }

    public function patient_givefeedback(Request $request)
    {

        if ($request->type == 'typing') {
            $doctor = doctor::select()
                ->where('id', $request->doctor_id)
                ->where('doctors.approve', 1)
                ->first();
        } else {
            $doctor = doctor::select()
                ->where('call_id', $request->call_id)
                ->where('doctors.approve', 1)
                ->first();
        }
        $consultant = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $doctor->id)
            ->where('type', $request->type)
            ->where('status', 'now')
            ->first();
        if($consultant){
            $consultant->rate = $request->rate;
            $consultant->feedback = $request->feedback;
            $consultant->status = 'old';
            $consultant->save();
        }
        $consultantc = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('type','video')
            ->where('status', 'now')
            ->first();
        if ($consultantc) {
            $consultantc->status = 'old';
            $consultantc->save();
        }
        $consultantc = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('type','voice')
            ->where('status', 'now')
            ->first();
        if ($consultantc) {
            $consultantc->status = 'old';
            $consultantc->save();
        }
        $rt = array('status' => 'success');

        $receiver_token = doctor::select('fcmToken')->where('id', $request->doctor_id)->first()->fcmToken;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => array($receiver_token),
            'data' => array(
                "msgBody" => "update",
            ),
            'notification' => null,

        );
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=AAAAguxeo2E:APA91bFcTC1Q5JG3ClfhMeYyhgRdjYdP-KkEfvwz57sAGkt3yhPBlGcQre7KQFeJ9eYdTiarGrkglN4wzaxyWstsFnS6tY7NT8ZTdGSag8jGW9hnWkyrWolsf_0LQSw0WojWF_PjxVox',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
      
        return json_encode($rt);
        curl_close($ch);
    }
  public function patient_givefeedbacks(Request $request)
    {

        if ($request->type == 'typing') {
            $doctor = doctor::select()
                ->where('id', $request->doctor_id)
                ->where('doctors.approve', 1)
                ->first();
        } else {
            $doctor = doctor::select()
                ->where('call_id', $request->call_id)
                ->where('doctors.approve', 1)
                ->first();
        }
        $consultant = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $doctor->id)
            ->where('type', $request->type)
            ->where('status', 'now')
            ->first();
        if($consultant){
            $consultant->rate = $request->rate;
            $consultant->feedback = $request->feedback;
            $consultant->status = 'old';
            $consultant->save();
        }
        $consultantc = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('type','video')
            ->where('status', 'now')
            ->first();
        if ($consultantc) {
            $consultantc->status = 'old';
            $consultantc->save();
        }
        $consultantc = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('type','voice')
            ->where('status', 'now')
            ->first();
        if ($consultantc) {
            $consultantc->status = 'old';
            $consultantc->save();
        }
        $rt = array('status' => 'success');

        $receiver_token = patient::select('fcmToken')->where('id', $request->patient_id)->first()->fcmToken;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => array($receiver_token),
            'data' => array(
                "msgBody" => "update",
            ),
            'notification' => null,

        );
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=AAAAguxeo2E:APA91bFcTC1Q5JG3ClfhMeYyhgRdjYdP-KkEfvwz57sAGkt3yhPBlGcQre7KQFeJ9eYdTiarGrkglN4wzaxyWstsFnS6tY7NT8ZTdGSag8jGW9hnWkyrWolsf_0LQSw0WojWF_PjxVox',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
      
        return json_encode($rt);
        curl_close($ch);
    }
    public function patient_startConsultant(Request $request)
    {
        $consultantc = consultant::select()
            ->where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('type', $request->type)
            ->where('status', 'now')
            ->first();
        if ($consultantc) {
            $rt = array('status' => 'faild');
            return json_encode($rt);
        }
        $doctor = doctor::select()
            ->where('id', $request->doctor_id)
            ->where('doctors.approve', 1)
            ->first();
        $patient = patient::select()
            ->where('id', $request->patient_id)
            ->first();
        $menulist = menulist::select()
            ->where('id', $request->menulist_id)
            ->first();
        if ($request->type == 'typing') {
            if(intval($patient->money) < intval($doctor->remain_chat)){
                $rt = array('status' => 'noenough');
                return json_encode($rt);
            }
        } else if ($request->type == 'voice') {
            if(intval($patient->money) < intval($doctor->remain_call)){
                $rt = array('status' => 'noenough');
                return json_encode($rt);
            }

        } else if ($request->type == 'video') {
            if(intval($patient->money) < intval($doctor->remain_video)){
                $rt = array('status' => 'noenough');
                return json_encode($rt);
            }
        }
        $consultant = new consultant();
        $consultant->doctor_id = $request->doctor_id;
        $consultant->patient_id = $request->patient_id;
        $consultant->type = $request->type;
        $consultant->status = 'now';
        $consultant->save();

        if ($request->type == 'typing') {
            $patient->money = intval($patient->money) - intval($doctor->remain_chat);
            $doctor->money = intval($doctor->money) + intval($doctor->remain_chat) * 0.8;
        } else if ($request->type == 'voice') {
            $patient->money = intval($patient->money) - intval($doctor->remain_call);
            $doctor->money = intval($doctor->money) + intval($doctor->remain_call) * 0.8;

        } else if ($request->type == 'video') {
            $patient->money = intval($patient->money) - intval($doctor->remain_video);
            $doctor->money = intval($doctor->money) + intval($doctor->remain_video) * 0.8;

        }
        $doctor->save();
        $patient->save();
        $rt = array('status' => 'success', 'consultant' => $consultant);
        $receiver_token = doctor::select('fcmToken')->where('id', $request->doctor_id)->first()->fcmToken;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => array($receiver_token),
            'data' => array(
                "msgBody" => "update",
            ),
            'notification' => null,

        );
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=AAAAguxeo2E:APA91bFcTC1Q5JG3ClfhMeYyhgRdjYdP-KkEfvwz57sAGkt3yhPBlGcQre7KQFeJ9eYdTiarGrkglN4wzaxyWstsFnS6tY7NT8ZTdGSag8jGW9hnWkyrWolsf_0LQSw0WojWF_PjxVox',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);

        return json_encode($rt);
        curl_close($ch);
    }

    public function patient_attached(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = rand(100000, 999999) . $_FILES["file"]["name"];
            $destinationPath = public_path('../../upload/chat');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $rt = array('status' => 'success', 'name' => $name);
            return json_encode($rt);
        }
        $rt = array('status' => 'failed');
        return json_encode($rt);
    }
}
