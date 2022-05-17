<?php

namespace App\Http\Controllers\Admin;

use App\consultant;
use App\User;
use App\Role;
use App\Admin;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\doctor;
use App\patient;
use App\menulist;
use App\specialist;
use App\definition;
use App\degree;
use App\country;
use App\city;
use App\area;
use App\contact;
use App\dcontact;
use App\fee;
use App\bank;

use Illuminate\Support\Facades\Mail;
use App\Mail\approv;
class HomeController extends Controller
{
    public function index()
    {
        $fee =fee::select()->where('id',1)->first();
        return view('admin.home')
                ->with('fee',$fee)
                ->with('name','Dashboard');
    }
    public function changefee(Request $request)
    {
        $fee =fee::select()->where('id',1)->first();
        $fee->price = $request->price;
        if($request->status == 1)
        {
            $fee->status = 1;
        }
        else
        {
            $fee->status = 0;
        }
        $fee->save();
        return back();
    }
    public function newdoctor()
    {

      //  DB::table('doctors as A, specialists as B, spec')
        $doctors = doctor::select('doctors.*','specialists.text as specialist1','B.text as specialist2','menulists.text as menulist','degrees.text as degree','countries.text as country','cities.text as city','areas.text as area')
                    ->where("approve",0)
                    ->leftjoin('specialists','specialists.id','=','doctors.specialist1_id')
                    ->leftjoin('menulists','menulists.id','=','doctors.menulist_id')
                    ->leftjoin('degrees','degrees.id','=','doctors.degree_id')
                    ->leftjoin('specialists as B','B.id','=','doctors.specialist2_id')
                    ->leftjoin('countries','countries.id','=','doctors.country_id')
                    ->leftjoin('cities','cities.id','=','doctors.city_id')
                    ->leftjoin('areas','areas.id','=','doctors.area_id')
                    ->get();
        return view('admin.newdoctor')
                ->with('doctors',$doctors)
                ->with('name','New doctors');
    }
    public function listdoctor()
    {

      //  DB::table('doctors as A, specialists as B, spec')
        $doctors = doctor::select('doctors.*','specialists.text as specialist1','B.text as specialist2','menulists.text as menulist','degrees.text as degree','countries.text as country','cities.text as city','areas.text as area')
                    ->where("approve",1)
                    ->leftjoin('specialists','specialists.id','=','doctors.specialist1_id')
                    ->leftjoin('menulists','menulists.id','=','doctors.menulist_id')
                    ->leftjoin('degrees','degrees.id','=','doctors.degree_id')
                    ->leftjoin('specialists as B','B.id','=','doctors.specialist2_id')
                    ->leftjoin('countries','countries.id','=','doctors.country_id')
                    ->leftjoin('cities','cities.id','=','doctors.city_id')
                    ->leftjoin('areas','areas.id','=','doctors.area_id')
                    ->get();
        return view('admin.listdoctor')
                ->with('doctors',$doctors)
                ->with('name','List doctors');
    }
    public function consultant()
    {

        //  DB::table('doctors as A, specialists as B, spec')
        $consultants = consultant::select('consultants.*', 'patients.name as patientname',  'doctors.fname as doctorfname', 'doctors.lname as doctorlname', 'doctors.remain_chat as pricechat', 'doctors.remain_call as pricevoice', 'doctors.remain_video as pricevideo')
            ->where("consultants.status",'now')
            ->leftjoin('patients','patients.id','=','consultants.patient_id')
            ->leftjoin('doctors', 'doctors.id', '=', 'consultants.doctor_id')
            ->get();
        return view('admin.consultant')
            ->with('consultants',$consultants)
            ->with('name','Consultant');
    }
    public function editDoctor(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->ids)->first();
        $doctoremail = $doctor->email;
        if($doctor->email == $request->demail){
            $doctor->fname = $request->fname;
            $doctor->lname = $request->lname;
            $doctor->password = base64_encode($request->password);
            $doctor->save();
            $user = User::select()->where('email',$doctor->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return back();
        }
        $user = User::select()->where('email',$request->demail)->first();
        if($user)  return back();
        $doctor->fname = $request->fname;
        $doctor->lname = $request->lname;
        $doctor->email = $request->demail;
        $doctor->password = base64_encode($request->password);
        $doctor->save();
        $user1 = User::select()->where('email',$doctoremail)->first();
        $user1->password = bcrypt($request->password);
        $user1->email = $request->demail;
        $user1->save();
        return back();
    }
    public function editPrice(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->id)->first();
        $doctor->remain_chat = $request->price_chat;
        $doctor->remain_call = $request->price_voice;
        $doctor->remain_video = $request->price_video;
        $doctor->save();
        return back();
    }
    public function approvedoctor(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        $user = new User();
        $user->name = $doctor->fname;
        $user->email = $doctor->email;
        $user->password = bcrypt(base64_decode($doctor->password));
        $user->save();

        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        $doctor->approve = 1;
        $url = "https://ehospital.online/viewprofile/".$doctor->id;
        $name = rand(100000, 999999).$doctor->fname.$doctor->lname;
        \QrCode::size(500)
            ->format('png')
            ->generate($url, public_path('../../upload/pcode/'.$name));
        $doctor->pcode= $name;
        $doctor->save();
        Mail::to($doctor->email)->send(new approv($doctor));
    }
    public function saveconnectcube(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        $doctor->call_id = $request->id;
        $doctor->call_password = $request->password;
        $doctor->call_login = $request->login;
        $doctor->save();
    }
    public function declinedoctor(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        if($doctor->approve == 1)
        {
            $user = User::select()
                ->where('email',$doctor->email)
                ->first();
            if($user != '')
             $user->delete();
        }
        $doctor->delete();
    }
    public function balancedoctor(Request $request)
    {
        $doctor = doctor::select()->where('id',$request->doctor_id)->first();
        $doctor->money = 0;
        $doctor->save();
    }

    public function bank()
    {
        $bank = bank::select('banks.*','doctors.fname','doctors.lname')
                    ->leftjoin('doctors','doctors.id','=','banks.doctor_id')
                    ->get();
        return view('admin.bank')
                ->with('banks',$bank)
                ->with('name','Bank');
    }
    public function menulist()
    {
        $menulist = menulist::select()->get();
        return view('admin.menulist')
                ->with('menulists',$menulist)
                ->with('name','Menulist');
    }
    public function newmenulist(Request $request)
    {
        $menulist = new menulist();
        $menulist->text = $request->text;
        $menulist->price_chat = $request->price_chat;
        $menulist->price_voice = $request->price_voice;
        $menulist->price_video = $request->price_video;
        $menulist->save();
        return back();
    }
    public function editmenulist(Request $request)
    {
        $menulist = menulist::select()->where('id',$request->id)->first();
        $menulist->text = $request->text;
        $menulist->price_chat = $request->price_chat;
        $menulist->price_voice = $request->price_voice;
        $menulist->price_video = $request->price_video;
        $menulist->save();
        return back();
    }
    public function deletemenulist($id)
    {
        $menulist = menulist::select()->where('id',$id)->first();
        $menulist->delete();
        return back();
    }

    public function specialist()
    {
        $specialist = specialist::select('specialists.*','menulists.text as menulist')
                    ->leftjoin('menulists','menulists.id','=','specialists.menulist_id')
                    ->get();
        $menulist = menulist::select()->get();
        return view('admin.specialist')
                ->with('specialists',$specialist)
                ->with('menulists',$menulist)
                ->with('name','Specialist');
    }
    public function newspecialist(Request $request)
    {
        $specialist = new specialist();
        $specialist->text = $request->text;
        $specialist->menulist_id = $request->menulist_id;
        $specialist->save();
        return back();
    }
    public function editspecialist(Request $request)
    {
        $specialist = specialist::select()->where('id',$request->id)->first();
        $specialist->text = $request->text;
        $specialist->menulist_id = $request->menulist_id;
        $specialist->save();
        return back();
    }
    public function deletespecialist($id)
    {
        $specialist = specialist::select()->where('id',$id)->first();
        $specialist->delete();
        return back();
    }

    public function definition()
    {
        $definition = definition::select('definitions.*','menulists.text as menulist')
                    ->leftjoin('menulists','menulists.id','=','definitions.menulist_id')
                    ->get();
        $menulist = menulist::select()->get();
        return view('admin.definition')
                ->with('definitions',$definition)
                ->with('menulists',$menulist)
                ->with('name','Definition');
    }
    public function newdefinition(Request $request)
    {
        $definition = new definition();
        $definition->text = $request->text;
        $definition->menulist_id = $request->menulist_id;
        $definition->save();
        return back();
    }
    public function editdefinition(Request $request)
    {
        $definition = definition::select()->where('id',$request->id)->first();
        $definition->text = $request->text;
        $definition->menulist_id = $request->menulist_id;
        $definition->save();
        return back();
    }
    public function deletedefinition($id)
    {
        $definition = definition::select()->where('id',$id)->first();
        $definition->delete();
        return back();
    }

    public function degree()
    {
        $degree = degree::select()->get();
        return view('admin.degree')
                ->with('degrees',$degree)
                ->with('name','Degree');
    }
    public function newdegree(Request $request)
    {
        $degree = new degree();
        $degree->text = $request->text;
        $degree->save();
        return back();
    }
    public function editdegree(Request $request)
    {
        $degree = degree::select()->where('id',$request->id)->first();
        $degree->text = $request->text;
        $degree->save();
        return back();
    }
    public function deletedegree($id)
    {
        $degree = degree::select()->where('id',$id)->first();
        $degree->delete();
        return back();
    }

    public function country()
    {
        $country = country::select()->get();
        return view('admin.country')
                ->with('countries',$country)
                ->with('name','Country');
    }
    public function newcountry(Request $request)
    {
        $country = new country();
        $country->text = $request->text;
        $country->save();
        return back();
    }
    public function editcountry(Request $request)
    {
        $country = country::select()->where('id',$request->id)->first();
        $country->text = $request->text;
        $country->save();
        return back();
    }
    public function deletecountry($id)
    {
        $country = country::select()->where('id',$id)->first();
        $country->delete();
        return back();
    }


    public function city()
    {
        $city = city::select('cities.*','countries.text as country')
                    ->leftjoin('countries','countries.id','=','cities.country_id')
                    ->get();
        $country = country::select()->get();
        return view('admin.city')
                ->with('cities',$city)
                ->with('countries',$country)
                ->with('name','City');
    }
    public function newcity(Request $request)
    {
        $city = new city();
        $city->text = $request->text;
        $city->country_id = $request->country_id;
        $city->save();
        return back();
    }
    public function editcity(Request $request)
    {
        $city = city::select()->where('id',$request->id)->first();
        $city->text = $request->text;
        $city->country_id = $request->country_id;
        $city->save();
        return back();
    }
    public function deletecity($id)
    {
        $city = city::select()->where('id',$id)->first();
        $city->delete();
        return back();
    }

    public function area()
    {
        $area = city::select('areas.*','countries.text as country','cities.text as city')
                    ->join('areas','areas.city_id','=','cities.id')
                    ->leftjoin('countries','countries.id','=','cities.country_id')
                    ->get();
        $city = city::select('cities.*','countries.text as country')
                    ->leftjoin('countries','countries.id','=','cities.country_id')
                    ->get();
        return view('admin.area')
                ->with('areas',$area)
                ->with('cities',$city)
                ->with('name','area');
    }
    public function newarea(Request $request)
    {
        $area = new area();
        $area->text = $request->text;
        $area->city_id = $request->city_id;
        $area->save();
        return back();
    }
    public function editarea(Request $request)
    {
        $area = area::select()->where('id',$request->id)->first();
        $area->text = $request->text;
        $area->city_id = $request->city_id;
        $area->save();
        return back();
    }
    public function deletearea($id)
    {
        $area = area::select()->where('id',$id)->first();
        $area->delete();
        return back();
    }

    public function contact()
    {
        $contact = contact::select()->get();
        return view('admin.contact')
                ->with('contacts',$contact)
                ->with('name','Contact Us');
    }
    public function deletecontact($id)
    {
        $contact = contact::select()->where('id',$id)->first();
        $contact->delete();
        return back();
    }

    public function dcontact()
    {
        $dcontact = dcontact::select('doctors.fname','doctors.lname','patients.name','dcontacts.*')
                    ->leftjoin('doctors','doctors.id','=','dcontacts.doctor_id')
                    ->leftjoin('patients','patients.id','=','dcontacts.patient_id')
                    ->get();
        return view('admin.dcontact')
                ->with('dcontacts',$dcontact)
                ->with('name','Message From Doctors');
    }
    public function deletedcontact($id)
    {
        $dcontact = dcontact::select()->where('id',$id)->first();
        $dcontact->delete();
        return back();
    }
}
