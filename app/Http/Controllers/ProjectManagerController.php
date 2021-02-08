<?php

namespace App\Http\Controllers;

use App\Mail\CreatePassword;
use App\Models\Role;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProjectManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('Epm.PMs.pm-dashboard',compact('user'));
    }

    public function pms()
    {
        $admin_user = Auth::user();
        $role = DB::table('roles')->where('name','Project Manager')->first();
        $project_managers = '';
        if ($role){
            $project_managers = User::orderBy('id','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-pms',compact('project_managers','admin_user'));
    }

    public function centers(){
        $admin_user = Auth::user();
        $centers = DB::table('centers')->get();
        return view('Epm.PMs.pm-list-centers',compact('centers','admin_user'));
    }

    public function cms_list()
    {
        $admin_user = Auth::user();
        $center_managers = '';
        $role = DB::table('roles')->where('name','Center Manager')->first();
        if ($role){
            $center_managers = User::orderBy('created_at','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-cms',compact('center_managers','admin_user'));
    }

    public function cm_add()
    {
        $centers = DB::table('centers')->get();
        return view('Epm.PMs.pm-add-cm',compact('centers'));
    }

    public function trainers_list()
    {
        $admin_user = Auth::user();
        $trainers='';
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = User::orderBy('created_at','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-trainers',compact('trainers','admin_user'));
    }

    public function trainer_add()
    {
        return view('Epm.PMs.pm-add-trainer');
    }

    public function mentors_list()
    {
        $admin_user = Auth::user();
        $mentors = '';
        $role = DB::table('roles')->where('name','Mentor')->first();
        if ($role){
            $mentors = DB::table('mentors')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-mentors',compact('mentors','admin_user'));
    }

    public function mentor_add()
    {
        return view('Epm.PMs.pm-add-mentor');
    }

    public function sessions_list()
    {
        $admin_user = Auth::user();
        $sessions = DB::table('training_sessions')->get();
        return view('Epm.PMs.pm-list-sessions',compact('sessions','admin_user'));
    }

    public function session_add()
    {
        $role = DB::table('roles')->where('name','Trainer')->first();
        $trainers = DB::table('users')->where('role_id',$role->id)->get();
        return view('Epm.PMs.pm-add-session',compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $creator = User::find($id);
        $messages = [
            'name.regex'=>'Name can not contain numbers and or special characters'
        ];
        $this->validate($request,
            [
//                'name' => ['required', 'string', 'max:255','regex:/^([A-Za-z]+) ?([A-Za-z]+)? ?([A-Za-z]+)? ?([A-Za-z]+)?$/'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'unique:users','regex:/\w+\.?\w+@\w+\.\w{2,3}(\.\w{2,3})?$/'],
                'phone' => ['required','regex:/^(\+254|0)\d{9}$/','unique:users'],
                'gender' => ['required'],
                'employee_number' => ['required','unique:users'],
                'county' => ['required'],
                'department' => ['required'],
                'image'=>['image|mimes:png,jpg,jpeg|max:1000'],
            ],$messages
        );
//TODO: create/add a new Project Manager
        $pm_user = new User();
        $pm_user->name = request('name');
        $pm_user->email = request('email');
        $email = $pm_user->email;
        $pm_user->phone = '';
        $pm_user->gender = request('gender');
        $pm_user->employee_number = request('employee_number');
        $pm_user->county = request('county');
        $phone = request('phone');
        $country_code = substr($phone,0,4);
        if ($country_code == +254){
            $minus_code = substr($phone,4,strlen($phone));
            $new_phone = '0'.$minus_code;
            $pm_user->phone = $new_phone;
        }else{
            $pm_user->phone = $phone;
        }
        $pm_user->bio = $request->bio;
        $pm_user->department = $request->department;
        $pm_user->creator_id = $creator->id;
        $pm_user->is_admin = 1;
//        $pm_user->password =Hash::make(request('password'));
        if ($request->hasFile('image')){
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('ProjectManagers/images',$fileName);
                $pm_user->image = $fileName;
            }
        }
        $pm_user->role_id = '';
//        TODO: assign project Manager role to the new PM
// first create the role
        $role = new Role();
        $role->name = 'Project Manager';
//        check if role exists in the db
        $existing_record = DB::table('roles')->where('name',$role->name)->first();
//        if yes get the role id and assign it to the new PM
        if ($existing_record){
            $pm_user->role_id = $existing_record->id;
        }
        else{
//        if no record found save the new role, get its id and assign it to the new PM
            $role->save();
            $pm_user->role_id = $role->id;
        }
//        after success assign Project Manager role to new Pm, save the new PM
        $pm_user_saved = $pm_user->save();
//finally redirect su admin to Project Managers page with a list of other projects managers previously created
        if ($pm_user_saved){
            //create a data array to pass to the mailable class to send email invite
            $data = [
                'user_id'=>$pm_user->id,
                'name' => $pm_user->name,
                'email' => $pm_user->email,
                'phone' => $pm_user->phone,
            ];
//            call the mailable class and send the email
            Mail::to($email)->send(new CreatePassword($data));
            //alert su admin success created pm user
            return redirect('/list/all/admins/role_id='.$pm_user->role_id)->with('success','Project Manager Added Successfully');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
