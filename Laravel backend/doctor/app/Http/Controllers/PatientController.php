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
use App\User;
use App\money;
use App\chatone;
use Illuminate\Support\Facades\Mail;
use App\Mail\unreadmessage;
class PatientController extends Controller
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

            $patient = patient::select()->where('email',Auth::user()->email)->first();
            if($patient)
                return $next($request);
            return redirect('/');
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function plogout()
    {
        Auth::logout(); // log the user out of our application
        return redirect('/'); // redirect the user to the login screen
    }
    public function pprofile()
    {
        $patient = patient::select()
                    ->where("email",Auth::user()->email)
                    ->first();
        return view('patient/profile')
                ->with('patient',$patient)
                ->with('status','profile');
    }
    public function pconsultation()
    {
        $patient = patient::select()
                    ->where("email",Auth::user()->email)
                    ->first();
        $ndoctor = doctor::select()
                    ->where('approve',1)
                    ->count();
        $nspecialist = specialist::select()->count();
        $menulist = menulist::select()->get();
        $doctor = doctor::select()
                    ->where('approve',1)
                    ->get();
        return view('patient/home')
                ->with('patient',$patient)
                ->with('ndoctor',$ndoctor)
                ->with('nspecialist',$nspecialist)
                ->with('menulists',$menulist)
                ->with('doctors',$doctor)
                ->with('status','profile');
    }
    public function addmoney()
    {
        $patient = patient::select()
                ->where("email",Auth::user()->email)
                ->first();
        return view('patient/addmoney')
            ->with('patient',$patient)
            ->with('error','')
            ->with('status','addmoney');
    }
    public function changepassword()
    {
        $patient = patient::select()
                ->where("email",Auth::user()->email)
                ->first();
        return view('patient/changepassword')
            ->with('patient',$patient)
            ->with('error','')
            ->with('status','changepassword');
    }
    public function ponemenulist($id)
    {
        $patient = patient::select()
                    ->where("email",Auth::user()->email)
                    ->first();
        $ndoctor = doctor::select()
                    ->where('approve',1)
                    ->count();
        $nspecialist = specialist::select()->count();
        $menulist = menulist::select()
                    ->where('id','!=',$id)
                    ->get();
        $cmenulist = menulist::select()
                    ->where('id',$id)
                    ->first();
        $definition = definition::select()
                    ->where('menulist_id',$id)
                    ->get();
        $doctor = doctor::select('doctors.*','specialists.text as specialist1','B.text as specialist2','menulists.text as menulist','degrees.text as degree')
                    ->leftjoin('specialists','specialists.id','=','doctors.specialist1_id')
                    ->leftjoin('menulists','menulists.id','=','doctors.menulist_id')
                    ->leftjoin('degrees','degrees.id','=','doctors.degree_id')
                    ->leftjoin('specialists as B','B.id','=','doctors.specialist2_id')
                    ->where('approve',1)
                    ->get();
        return view('patient/onemenulist')
                ->with('patient',$patient)
                ->with('ndoctor',$ndoctor)
                ->with('nspecialist',$nspecialist)
                ->with('menulists',$menulist)
                ->with('doctors',$doctor)
                ->with('definitions',$definition)
                ->with('menulist_id',$id)
                ->with('cmenulist',$cmenulist)
                ->with('status','onemenulist');
    }
    public function ponedoctor($id)
    {
        $patient = patient::select()
                    ->where("email",Auth::user()->email)
                    ->first();
        $doctor = doctor::select('doctors.*','specialists.text as specialist1','B.text as specialist2','menulists.text as menulist','menulists.price_chat as price_chat','menulists.price_voice as price_voice','menulists.price_video as price_video','degrees.text as degree','countries.text as country','cities.text as city','areas.text as area')
            ->where("doctors.id",$id)
            ->leftjoin('specialists','specialists.id','=','doctors.specialist1_id')
            ->leftjoin('menulists','menulists.id','=','doctors.menulist_id')
            ->leftjoin('degrees','degrees.id','=','doctors.degree_id')
            ->leftjoin('specialists as B','B.id','=','doctors.specialist2_id')
            ->leftjoin('countries','countries.id','=','doctors.country_id')
            ->leftjoin('cities','cities.id','=','doctors.city_id')
            ->leftjoin('areas','areas.id','=','doctors.area_id')
            ->first();
        return view('patient/onedoctor')
                ->with('patient',$patient)
                ->with('doctor',$doctor)
                ->with('status','onedoctor');
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
    public function pupdateprofile(Request $request)
    {
        $patient = patient::select()
                    ->where('email',Auth::user()->email)
                    ->first();
        $patient->name = $request->name;
        $old = User::select()->where('email',$request->email)->first();
        if($patient->email != $request->email && isset($old))
        {
            return back();
        }
        $user = User::select()->where('email',$patient->email)->first();
        $patient->email = $request->email;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        if ($request->hasFile('photo')) {
            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              ]);
            $image = $request->file('photo');
            $name = rand(100000, 999999).$_FILES["photo"]["name"];
            $destinationPath = public_path('../../upload/avata');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $patient->photo = $name;
        }
        $patient->address = $request->address;
        $patient->more_info = $request->more_info;
        $patient->save();
        return back();
    }
    public function createmessage($id)
    {
        $patient = patient::select()
            ->where('email',Auth::user()->email)
            ->first();
        $consultantc = consultant::select()
                    ->where('patient_id',$patient->id)
                    ->where('doctor_id',$id)
                    ->where('type','typing')
                    ->where('status','now')
                    ->first();
        if($consultantc)
        {
            return redirect('/onemessage/'.$consultantc->id);
        }
        $doctor = doctor::select()
                    ->where('id',$id)
                    ->where('doctors.approve',1)
                    ->first();
        $menulist = menulist::select()
                    ->where('id',$doctor->menulist_id)
                    ->first();
        if($patient->money < $menulist->price_chat)
        {
            return view('patient/bonemessage')
                ->with('patient',$patient)
                ->with('id',$id)
                ->with('status','pmessage')
                ->with('statusone','good');
        }

        $consultant = new consultant();
        $consultant->doctor_id = $id;
        $consultant->patient_id = $patient->id;
        $consultant->type = 'typing';
        $consultant->status = 'now';
        $consultant->save();


        $patient->money = intval($patient->money) - intval($menulist->price_chat);
        $doctor->money = intval($doctor->money) + intval($menulist->price_chat)*0.8;

        $doctor->save();
        $patient->save();
        return redirect('/onemessage/'.$consultant->id);
    }
    public function createunmessage($id)
    {
        $patient = patient::select()
            ->where('email',Auth::user()->email)
            ->first();
        return view('patient/bonemessage')
            ->with('patient',$patient)
            ->with('id',$id)
            ->with('status','pmessage')
            ->with('statusone','bad');
    }
    public function ppassword(Request $request)
    {
        $patient = patient::select()->where('email',Auth::user()->email)->first();
        if($request->current != base64_decode($patient->password))
        {
            return view('patient/changepassword')
                ->with('patient',$patient)
                ->with('error','الايميل او الرمز المدخل غير صحيح, يرجى التحقق والمحاولة مرة أخرى')
                ->with('status','changepassword');
        }
        $patient->password = base64_encode($request->new);
        $patient->save();
        $user = User::select()->where('email',$patient->email)->first();
        $user->password = bcrypt($request->new);
        $user->save();
        return view('patient/changepassword')
            ->with('patient',$patient)
            ->with('error','no')
            ->with('status','changepassword');
    }
    public function pcontact()
    {
        $patient = patient::select()
            ->where("email",Auth::user()->email)
            ->first();
        return view('patient/pcontact')
                ->with('patient',$patient)
                ->with('status','pcontact')
                ->with('statusone','start');
    }
    public function pcontactus(Request $request)
    {
        $patient = patient::select()
            ->where("email",Auth::user()->email)
            ->first();
        $dcontact = New dcontact();
        $dcontact->patient_id = $patient->id;
        $dcontact->title = $request->title;
        $dcontact->text = $request->message;
        $dcontact->save();
        return view('patient/pcontact')
                ->with('patient',$patient)
                ->with('status','pcontact')
                ->with('statusone','after');
    }
    public function addmoneyaccount(Request $request)
    {
        \Stripe\Stripe::setApiKey ( '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' );
        try {
        $stripeToken =
        \Stripe\Token::create([
            'card' => [
              'number' => $request->cardnumber,
              'exp_month' =>  $request->exp_month,
              'exp_year' =>'20'.$request->exp_year,
              'cvc' => $request->cvc,
            ],
          ]);
          }  catch ( \Exception $e )
        {
            $patient = patient::select()
                ->where("email",Auth::user()->email)
                ->first();
            return view('patient/addmoney')
                ->with('patient',$patient)
                ->with('error',"failed : " . $e->getMessage())
                ->with('status','addmoney');
        }
        try {
            \Stripe\Charge::create ( array (
                    "amount" => intval($request->amount)*100,
                    "currency" => "usd",
                    "source" => $stripeToken , // obtained with Stripe.js
                    "description" => "Add Money to account."
            ) );

            $patient = patient::select()
                    ->where('email',Auth::user()->email)
                    ->first();
            $money = new money();
            $money->user_id = $patient->id;
            $money->type = 'patient';
            $money->price = $request->amount;
            $money->save();
            $patient->money = intval($patient->money) + intval($request->amount);
            $patient->save();
            return view('patient/addmoney')
                ->with('patient',$patient)
                ->with('error',"no")
                ->with('status','addmoney');
        } catch ( \Exception $e )
        {
            $patient = patient::select()
                ->where("email",Auth::user()->email)
                ->first();
            return view('patient/addmoney')
                ->with('patient',$patient)
                ->with('error',"failed : " . $e->getMessage())
                ->with('status','addmoney');
        }
    }
    public function pmessage()
    {
        $patient = patient::select()
            ->where("email",Auth::user()->email)
            ->first();
        $consultant = consultant::select('consultants.*','doctors.fname','doctors.lname')
                        ->where('patient_id',$patient->id)
                        ->leftjoin('doctors','doctors.id','=','consultants.doctor_id')
                        ->orderBy('consultants.id', 'desc')
                        ->get();
        $unreadchats = consultant::select('consultants.id')
                        ->where('consultants.status','now')
                        ->where('patient_id',$patient->id)
                        ->where('chatones.who',1)
                        ->leftjoin('chatones','chatones.consultant_id','=','consultants.id')
                        ->where('chatones.status','unread')
                        ->orderBy('chatones.created_at', 'desc')
                        ->get();
        return view('patient/message')
            ->with('patient',$patient)
            ->with('unreadchats',$unreadchats)
            ->with('consultants',$consultant)
            ->with('status','pmessage')
            ->with('statusone','good');
    }
    public function onemessage($id)
    {
        $patient = patient::select()
            ->where("email",Auth::user()->email)
            ->first();
        $chats = chatone::select()
            ->where('consultant_id',$id)
            ->get();
        $consultant = consultant::select()
            ->where('id',$id)
            ->first();
        $doctor = doctor::select('doctors.*','menulists.text as menulist')
            ->leftjoin('menulists','menulists.id','=','doctors.menulist_id')
            ->where('doctors.id',$consultant->doctor_id)
            ->first();
        return view('patient/onemessage')
            ->with('patient',$patient)
            ->with('chats',$chats)
            ->with('doctor',$doctor)
            ->with('consultant_id',$id)
            ->with('status','pmessage');
    }
    public function psavechatone(Request $request)
    {
        $chatone = New chatone();
        $chatone->consultant_id = $request->consultant_id;
        $chatone->who = 0;
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
        $doctor = doctor::where('id',$consultant->doctor_id)->first();
        $patient = patient::where("email",Auth::user()->email)->first();
        $name1 = $doctor->fname.' '.$doctor->lname;
        $name2 = $patient->name;
        Mail::to($doctor->email)->send(new unreadmessage($name1,$name2));

        echo $chatone->text;
    }
    public function pgetchat(Request $request)
    {
        $data['chats'] = chatone::select()
            ->where('consultant_id',$request->consultant_id)
            ->get();
        $data['cur_time'] = date("Y-m-d H:i:s");

        return json_encode($data);
    }
    public function psetallstatus(Request $request)
    {
        $chats = chatone::select()
            ->where('consultant_id',$request->consultant_id)
            ->where('who',1)
            ->get();
        foreach($chats as $chat)
        {
            $chat->status = 'read';
            $chat->save();
        }
    }
    Public function getpunreadmessage()
    {
        $patient = patient::select()
            ->where("email",Auth::user()->email)
            ->first();
        $count = chatone::select()
            ->leftjoin('consultants','chatones.consultant_id','=','consultants.id')
            ->where('consultants.status','now')
            ->where('chatones.status','unread')
            ->where('chatones.who',1)
            ->where('consultants.patient_id',$patient->id)
            ->count();
        echo $count;
    }
    public function givefeedback(Request $request)
    {
        $consultant = consultant::select()
                    ->where('id',$request->consultant_id)
                    ->first();
        $consultant->rate = $request->rate;
        $consultant->feedback = $request->feedback;
        $consultant->status = 'old';
        $consultant->save();
        return redirect('/pmessage');
    }
}
