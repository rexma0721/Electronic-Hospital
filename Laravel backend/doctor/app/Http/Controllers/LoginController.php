<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\doctor;
use App\patient;
use App\User;
use App\menulist;
use App\specialist;

use Illuminate\Support\Facades\Mail;
use App\Mail\forgotpassword;
class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
              $this->user = Auth::user();
              if(Auth::user() != '')
                  return redirect('/profile');  
              return $next($request);
          });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function accountlogin(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $remember = $request['remember'];

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // The user is being remembered...
            //Update online status            
            $user = Auth::user();
            $user->save();
            $doctor = doctor::select()
                    ->where('approve',1)
                    ->where('email',$email)
                    ->first();
            if($doctor)
                return redirect('/profile');
            $patient = patient::select()
                    ->where('status','good')
                    ->where('email',$email)
                    ->first();
            if($patient)
                return redirect('/pconsultation');             
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
                ->with('status','retype');
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
    public function resetpassword($token)
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
                ->with('token', $token)
                ->with('status','reset');
    }
    public function verifyemail($token)
    {
        $ndoctor = doctor::select()
                    ->where('approve',1)
                    ->count();
        $nspecialist = specialist::select()->count();
        $menulist = menulist::select()->get();
        $doctor = doctor::select()
                    ->where('approve',1)
                    ->get();
        $user = user::select()->where('api_token',$token)->first();
        $patient = patient::select()->where('email',$user->email)->first();
        $patient->status="good";
        $patient->save();
        $user->name = $patient->name;
        $user->password = bcrypt(base64_decode($patient->password));
        $user->save();
        return view('home')
                ->with('ndoctor',$ndoctor)
                ->with('nspecialist',$nspecialist)
                ->with('menulists',$menulist)
                ->with('doctors',$doctor)
                ->with('status','verified');
    }
    public function resetnewpassword(Request $request)
    {
        $user = user::select()->where('api_token',$request->token)->first();
        $doctor = doctor::select()->where('email',$user->email)->first();
        $patient = patient::select()->where('email',$user->email)->first();
        if($doctor)
        {
            $doctor->password = base64_encode($request->newpasword);
            $doctor->save();
            
            $user->password = bcrypt(base64_decode($doctor->password));
            $user->save();
        }
        else if($patient)
        {
            $patient->password = base64_encode($request->newpasword);
            $patient->save();
            
            $user->password = bcrypt(base64_decode($patient->password));
            $user->save();
        }
        return redirect('/');
    }
}
