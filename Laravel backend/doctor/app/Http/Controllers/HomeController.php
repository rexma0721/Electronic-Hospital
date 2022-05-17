<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\doctor;
use App\patient;
use App\menulist;
use App\specialist;
use App\degree;
use App\country;
use App\city;
use App\area;
use App\contact;
use App\definition;
use App\fee;
use App\User;
use Illuminate\Support\Facades\Auth;
use Twilio\Jwt\ClientToken;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\verify;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
      $this->middleware(function ($request, $next) {
            if(Auth::user() == '')
                return $next($request);
            $doctor = doctor::select()->where('email',Auth::user()->email)->first();
            if($doctor)
                return redirect('/profile');
            $patient = patient::select()->where('email',Auth::user()->email)->first();
            if($patient)
                return redirect('/pconsultation');
        });
    }

    public function facebook_login()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function facebook_callback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            //$create['facebook_id'] = $user->getId();

            $checkdoctor  = doctor::select()
                        ->where('email',$create['email'])
                        ->first();

            if($checkdoctor)
            {
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
                    ->with('status','psameemail');
            }

            $patient  = patient::select()->where('email',$create['email'])->first();
            if (!$patient)
            {
                $patient = new patient();
                $patient->name = $create['name'];
                $patient->email = $create['email'];
                $patient->phone = '111111111111';
                $patient->username = $create['name'];
                $patient->sex = 0;
                $patient->status = 'bad';
                $patient->password = base64_encode('1234567890');
                $patient->save();

                $user = new User();
                $user->email = $create['email'];
                $user->name = $create['name'];
                $user->password = bcrypt("1234567890");
                $user->save();

            }

            if (Auth::attempt(['email' => $create['email'], 'password' => '1234567890'])) {
                // The user is being remembered...
                //Update online status
                $user = Auth::user();
                $user->save();
            }

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                ->with('status','index');
    }
    public function create()
    {
        $menulist = menulist::select()->get();
        $country = country::select()->get();
        $degree = degree::select()->get();
        $fee = fee::select()->where('id',1)->first();
        return view('create')
                ->with('menulists',$menulist)
                ->with('countries',$country)
                ->with('degrees',$degree)
                ->with('fee',$fee)
                ->with('status','create');
    }
    public function addfee(Request $request)
    {
        \Stripe\Stripe::setApiKey ( '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' );

        try {
        $stripeToken =
        \Stripe\Token::create([
            'card' => [
              'number' => $request->cardnumber,
              'exp_month' =>  $request->exp_month,
              'exp_year' => $request->exp_year,
              'cvc' => $request->cvc,
            ],
          ]);
        }
        catch ( \Exception $e )
        {
            return "failed : " . $e->getMessage();
        }
        $fee = fee::select()->where('id',1)->first();
        try {
            \Stripe\Charge::create ( array (
                    "amount" => intval($fee->price)*100,
                    "currency" => "usd",
                    "source" => $stripeToken , // obtained with Stripe.js
                    "description" => "Paid fee for account."
            ) );
            return 'success';
        } catch ( \Exception $e )
        {
            return "failed : " . $e->getMessage();
        }
    }
    public function createdoctor(Request $request)
    {
        $checkdoctor  = doctor::select()
                        ->where('email',$request->email)
                        ->first();
        $checkpatient  = patient::select()
                        ->where('email',$request->email)
                        ->first();
        $checkuser  = User::select()
                        ->where('email',$request->email)
                        ->first();
        if($checkdoctor||$checkpatient||$checkuser)
        {

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
                ->with('status','sameemail');
        }
        $doctor = new doctor();
        $doctor->fname = $request->fname;
        $doctor->lname = $request->lname;
        $doctor->email = $request->email;
        $doctor->password = base64_encode($request->password);
        $doctor->phone = $request->phone;
        $doctor->menulist_id = $request->menulist_id;
        $doctor->menulist2_id = $request->menulist2_id;
        $doctor->experience = $request->experience;

        $old = specialist::select()
                ->where('menulist_id',$request->menulist_id)
                ->where('text',$request->specialist)
                ->first();
        if(isset($old))
        {
            $doctor->specialist1_id = $old->id;
            $doctor->specialist2_id = $old->id;
        }
        else
        {
            $specialist = New specialist();
            $specialist->text= $request->specialist;
            $specialist->menulist_id= $request->menulist_id;
            $specialist->save();
            $doctor->specialist1_id = $specialist->id;
            $doctor->specialist2_id = $specialist->id;
        }

        $doctor->degree_id = $request->degree_id;
        $doctor->authorization_no = $request->authorization_no;
        $doctor->country_id = $request->country_id;
        $doctor->city_id = $request->city_id;
        $doctor->area_id = $request->area_id;
        $doctor->office_address = $request->office_address;
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
        if(strlen($request->video_link) > 11 && preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->video_link, $match))
            $doctor->video_link = $match[1];
        else if($request->video_link)
            $doctor->video_link = $request->video_link;
        $doctor->facebook_link = $request->facebook_link;
        $doctor->twitter_link = $request->twitter_link;
        $doctor->instagram_link = $request->instagram_link;
        $doctor->youtube_link = $request->youtube_link;
        $doctor->doctor_cv = $request->doctor_cv;
        $fee = fee::select()->where('id',1)->first();
        $doctor->fee = $request->fee+$fee->status*10;
        $doctor->status = 'good';
        $doctor->save();
        return redirect('/');
    }
    public function createpatient(Request $request)
    {
        $checkdoctor  = doctor::select()
                        ->where('email',$request->email)
                        ->first();
        $checkpatient  = patient::select()
                        ->where('email',$request->email)
                        ->first();
        $checkuser  = User::select()
                        ->where('email',$request->email)
                        ->first();
        if($checkdoctor||$checkpatient||$checkuser)
        {

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
                ->with('status','psameemail');
        }
        $patient = new patient();
        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->username = $request->name;
        $patient->sex = 0;
        $patient->status = 'bad';
        $patient->password = base64_encode($request->password);
        $patient->save();
        $user = new User();
        $user->email = $request->email;
        $user->name = "hck0901han";
        $user->password = bcrypt("hck0901han");
        $user->save();
        Mail::to($request->email)->send(new verify($user));
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
            ->with('status','pemailsent');
    }
    public function onemenulist($id)
    {
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
        return view('onemenulist')
                ->with('ndoctor',$ndoctor)
                ->with('nspecialist',$nspecialist)
                ->with('menulists',$menulist)
                ->with('doctors',$doctor)
                ->with('definitions',$definition)
                ->with('menulist_id',$id)
                ->with('cmenulist',$cmenulist)
                ->with('status','onemenulist');
    }
    public function onedoctor($id)
    {
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
        return view('onedoctor')
                ->with('doctor',$doctor)
                ->with('status','onedoctor');
    }
    public function getspecialist(Request $request)
    {
        $specialist = specialist::select()->where('menulist_id',$request->menulist_id)->get();
        return json_encode($specialist);
    }
    public function getothermenulist(Request $request)
    {
        $menulist = menulist::select()->where('id','!=',$request->menulist_id)->get();
        return json_encode($menulist);
    }
    public function getcity(Request $request)
    {
        $city = city::select()->where('country_id',$request->country_id)->get();
        return json_encode($city);
    }
    public function getarea(Request $request)
    {
        $area = area::select()->where('city_id',$request->city_id)->get();
        return json_encode($area);
    }
    public function contactus(Request $request)
    {
        $contact = New contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone_number;
        $contact->email = $request->email;
        $contact->text = $request->message;
        $contact->save();
        return back();
    }
    public function sendsms(Request $request)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];

        $client = new Client(['auth' => [$accountSid, $authToken]]);
        $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
        [
            'form_params' => [
            'Body' => 'IRAQ Doctor Consultant APP Link ............. ', //set message body
            'To' => $request->phonenumber,
            'From' => '+19166194425' //we get this number from twilio
        ]]);
        return back();
    }
}
