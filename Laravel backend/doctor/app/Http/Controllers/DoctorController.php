<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\doctor;
use App\menulist;
use App\specialist;
use App\degree;
use App\country;
use App\city;
use App\area;
use App\contact;
use App\dcontact;
use App\consultant;
use App\patient;
use App\chatone;
use App\bank;
use Illuminate\Support\Facades\Mail;
use App\Mail\unreadmessage;
class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user() == '')
                return redirect('/');
            $doctor = doctor::select()->where('email',Auth::user()->email)->first();
            if($doctor)
                return $next($request);
            return redirect('/');
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function logout()
    {
        Auth::logout(); // log the user out of our application
        return redirect('/'); // redirect the user to the login screen
    }
    public function index()
    {
        $menulist = menulist::select()->get();
        $country = country::select()->get();
        $degree = degree::select()->get();
        $doctor = doctor::select('doctors.*','specialists.text as specialist1','B.text as specialist2','menulists.text as menulist','degrees.text as degree','countries.text as country','cities.text as city','areas.text as area')
            ->where("email",Auth::user()->email)
            ->leftjoin('specialists','specialists.id','=','doctors.specialist1_id')
            ->leftjoin('menulists','menulists.id','=','doctors.menulist_id')
            ->leftjoin('degrees','degrees.id','=','doctors.degree_id')
            ->leftjoin('specialists as B','B.id','=','doctors.specialist2_id')
            ->leftjoin('countries','countries.id','=','doctors.country_id')
            ->leftjoin('cities','cities.id','=','doctors.city_id')
            ->leftjoin('areas','areas.id','=','doctors.area_id')
            ->first();
        $city = city::select()->where('country_id',$doctor->country_id)->get();
        $area = area::select()->where('city_id',$doctor->city_id)->get();
        $specialist = specialist::select()->where('menulist_id',$doctor->menulist_id)->get();
        return view('doctor/profile')
                ->with('doctor',$doctor)
                ->with('menulists',$menulist)
                ->with('countries',$country)
                ->with('degrees',$degree)
                ->with('cities',$city)
                ->with('areas',$area)
                ->with('specialists',$specialist)
                ->with('status','profile');
    }
    public function updateprofile(Request $request)
    {
        $doctor = doctor::select()
                    ->where("email",Auth::user()->email)
                    ->first();
        $doctor->fname = $request->fname;
        $doctor->lname = $request->lname;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->menulist_id = $request->menulist_id;
        $doctor->specialist1_id = $request->specialist1_id;
        $doctor->degree_id = $request->degree_id;
        $doctor->specialist2_id = $request->specialist2_id;
        $doctor->authorization_no = $request->authorization_no;
        $doctor->country_id = $request->country_id;
        $doctor->city_id = $request->city_id;
        $doctor->area_id = $request->area_id;
        $doctor->office_address = $request->office_address;
        $doctor->experience = $request->experience;
        if ($request->hasFile('photo')) {
            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              ]);
            $image = $request->file('photo');
            $name = rand(100000, 999999).$_FILES["photo"]["name"];
            $destinationPath = public_path('../../upload/photo');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $doctor->photo = $name;
        }
        if ($request->hasFile('video_photo')) {
            $this->validate($request, [
                'video_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              ]);
            $image = $request->file('video_photo');
            $name = rand(100000, 999999).$_FILES["video_photo"]["name"];
            $destinationPath = public_path('../../upload/videophoto');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $doctor->video_photo = $name;
        }
        if( $request->service_chat == '1')
            $doctor->service_chat = 1;
        else
            $doctor->service_chat = 0;
        if( $request->service_call == '1')
            $doctor->service_call = 1;
        else
            $doctor->service_call = 0;
        if( $request->service_video == '1')
            $doctor->service_video = 1;
        else
            $doctor->service_video = 0;
        $doctor->work_start_time = $request->work_start_time;
        $doctor->work_end_time = $request->work_end_time;
        $doctor->work_start_day = $request->work_start_day;
        $doctor->work_end_day = $request->work_end_day;
        if (!isset($request->video_link) || $request->video_link == null)
            $doctor->video_link = 'https://www.youtube.com/watch?v=7DCOsK0-2kA&feature=emb_title';
        else if(strlen($request->video_link) > 11 && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->video_link, $match))
            $doctor->video_link = $match[1];
        else
            $doctor->video_link = $request->video_link;
        $doctor->facebook_link = $request->facebook_link;
        $doctor->twitter_link = $request->twitter_link;
        $doctor->instagram_link = $request->instagram_link;
        $doctor->youtube_link = $request->youtube_link;
        $doctor->doctor_cv = $request->doctor_cv;
        $doctor->save();
        return redirect('/');
    }
    public function consultation()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $consultant = consultant::select('patients.name','consultants.type','consultants.created_at')
            ->where('doctor_id',$doctor->id) 
            ->leftjoin('patients','patients.id','=','consultants.patient_id')
            ->get();

        return view('doctor/consultation')
                ->with('doctor',$doctor)
                ->with('consultants',$consultant)
                ->with('status','consultation');
    }
    public function dcontact()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();

        return view('doctor/dcontact')
                ->with('doctor',$doctor)
                ->with('status','dcontact');
    }
    public function manage()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $doctors = doctor::select()
            ->where("menulist_id",$doctor->menulist_id)
            ->where('id','!=',$doctor->id)
            ->get();
        return view('doctor/manage')
                ->with('doctor',$doctor)
                ->with('doctors',$doctors)
                ->with('status','manage');
    }
    public function dgetspecialist(Request $request)
    {
        $specialist = specialist::select()->where('menulist_id',$request->menulist_id)->get();
        return json_encode($specialist);
    }
    public function dgetcity(Request $request)
    {
        $city = city::select()->where('country_id',$request->country_id)->get();
        return json_encode($city);
    }
    public function dgetarea(Request $request)
    {
        $area = area::select()->where('city_id',$request->city_id)->get();
        return json_encode($area);
    }
    public function dcontactus(Request $request)
    {
        
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $dcontact = New dcontact();
        $dcontact->doctor_id = $doctor->id;
        $dcontact->title = $request->title;
        $dcontact->text = $request->message;
        $dcontact->save();
        return redirect('/');
    }
    public function dmessage()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $consultant = consultant::select('consultants.*','patients.name')
                        ->where('consultants.status', 'now')
                        ->where('doctor_id',$doctor->id)
                        ->leftjoin('patients','patients.id','=','consultants.patient_id')
                        ->orderBy('consultants.id', 'desc')
                        ->get(); 
    
        $unreadchats = consultant::select('consultants.id')
                        ->where('consultants.status','now')
                        ->where('doctor_id',$doctor->id)
                        ->where('chatones.who',0)
                        ->leftjoin('chatones','chatones.consultant_id','=','consultants.id')
                        ->where('chatones.status','unread')
                        ->orderBy('chatones.created_at', 'desc')
                        ->get(); 
        return view('doctor/message')
            ->with('doctor',$doctor)
            ->with('unreadchats',$unreadchats)
            ->with('consultants',$consultant)
            ->with('status','dmessage');
    }

    public function dendmessage()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $consultant = consultant::select('consultants.*','patients.name')
                        ->where('consultants.status', 'old')
                        ->where('doctor_id',$doctor->id)
                        ->leftjoin('patients','patients.id','=','consultants.patient_id')
                        ->orderBy('consultants.id', 'desc')
                        ->get(); 
    
        $unreadchats = consultant::select('consultants.id')
                        ->where('consultants.status','now')
                        ->where('doctor_id',$doctor->id)
                        ->where('chatones.who',0)
                        ->leftjoin('chatones','chatones.consultant_id','=','consultants.id')
                        ->where('chatones.status','unread')
                        ->orderBy('chatones.created_at', 'desc')
                        ->get(); 
        return view('doctor/endmessage')
            ->with('doctor',$doctor)
            ->with('unreadchats',$unreadchats)
            ->with('consultants',$consultant)
            ->with('status','dendmessage');
    }

    public function donemessage($id)
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $chats = chatone::select()
            ->where('consultant_id',$id)
            ->get();
        $consultant = consultant::select()
            ->where('id',$id)
            ->first();
        $patient = patient::select()
            ->where('id',$consultant->patient_id)
            ->first();
        return view('doctor/onemessage')
            ->with('doctor',$doctor)
            ->with('chats',$chats)
            ->with('patient',$patient)
            ->with('consultant_id',$id)
            ->with('status','dmessage');
    }
    public function dsavechatone(Request $request)
    {
        $chatone = New chatone();
        $chatone->consultant_id = $request->consultant_id;
        $chatone->who = 1;
        if($request->type == 'text')
        {
            $chatone->text = $request->text;
            $chatone->type = 'text';
        }
        else if ($request->type == 'audio')
        {
            if ($request->hasFile('text')) {
                $audio = $request->file('text');
                $name = 'voicemssage' . date("YmdHis") . '.wav';
                $destinationPath = public_path('../../upload/chat');
                $audio->move($destinationPath, $name);
                $chatone->text = $name;
            }
            $chatone->type = $request->type;
        }
        else
        {
            if ($request->hasFile('text')) {
                $image = $request->file('text');
                $name = rand(100000, 999999).$_FILES["text"]["name"];
                $destinationPath = public_path('../../upload/chat');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $chatone->text = $name;
            }
            $chatone->type = $request->type;
        }
        $chatone->status = 'unread';
        $chatone->save();

        $consultant = consultant::where('id',$request->consultant_id)->first();
        $patient = patient::where('id',$consultant->patient_id)->first();
        $doctor = doctor::where("email",Auth::user()->email)->first();
        $name1 = $patient->name;
        $name2 = $doctor->fname.' '.$doctor->lname;
        Mail::to($patient->email)->send(new unreadmessage($name1,$name2));

        echo $chatone->text . $name1 . $name2;
    }
    public function dgetchat(Request $request)
    {
        $data['chats'] = chatone::select()
            ->where('consultant_id',$request->consultant_id)
            ->get();
        $data['cur_time'] = date('Y-m-d H:i:s');
        return json_encode($data);
    }
    public function dsetallstatus(Request $request)
    {
        $chats = chatone::select()
            ->where('consultant_id',$request->consultant_id)
            ->where('who',0)
            ->get();
        foreach($chats as $chat)
        {
            $chat->status = 'read';
            $chat->save();
        }
    }
    Public function getdunreadmessage()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $count = chatone::select()
            ->leftjoin('consultants','chatones.consultant_id','=','consultants.id')
            ->where('consultants.status','now')
            ->where('chatones.status','unread')
            ->where('chatones.who',0)
            ->where('consultants.doctor_id',$doctor->id)
            ->count();
        echo $count;

    }

    public function bank()
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        $bank = bank::select()
        ->where("doctor_id",$doctor->id)
        ->first();
        return view('doctor/bank')
                ->with('doctor',$doctor)
                ->with('bank',$bank)
                ->with('status','bank');
    }
    public function addbankaccount(Request $request)
    {
        $doctor = doctor::select()
            ->where("email",Auth::user()->email)
            ->first();
        if($request->new == '0')
        {
            $bank = New bank();
            $bank->number = $request->number;
            $bank->type = $request->type;
            $bank->doctor_id = $doctor->id;
            $bank->save();
        }
        else
        {
            $bank = bank::select()
            ->where("doctor_id",$doctor->id)
            ->first();
            $bank->number = $request->number;
            $bank->type = $request->type;
            $bank->save();
        }
        return redirect('/bank');
    }

    public function givefeedback(Request $request)
    {
        $consultant = consultant::select()
                    ->where('id',$request->consultant_id)
                    ->first();
        $consultant->rate = 0;
        $consultant->feedback = '';
        $consultant->status = 'old';
        $consultant->save();
        return redirect('/dmessage');
    }
}
