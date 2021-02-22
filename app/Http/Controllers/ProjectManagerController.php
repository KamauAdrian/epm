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

    public function pmo(){
        $role = DB::table('roles')->where('name','Project Manager')->first();
        $result = [];
        if ($role){
            $pmos = DB::table('users')->where('role_id',$role->id)->get();
            if (!empty($pmos)){
                foreach ($pmos as $pmo){
                    $result[]=$pmo;
                }
            }
            return response()->json($result);
        }
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
            $data = $pm_user;
//            call the mailable class and send the email
            User::SendNewUserAccountActivationEmail($email,$data);
//            Mail::to($email)->send(new CreatePassword($data));
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
