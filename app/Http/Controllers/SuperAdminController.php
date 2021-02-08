<?php

namespace App\Http\Controllers;

use App\Mail\CreatePassword;
use App\Mail\WelcomeMail;
use App\Models\Center;
use App\Models\ProjectManager;
use App\Models\Role;
use App\Models\SessionClass;
use App\Models\TeamCenterManager;
use App\Models\TeamTrainer;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\True_;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('Epm.SuAdmins.adm-dashboard',);
    }

    public function su_admin_register(){
        return view('Epm.SuAdmins.su-admin-register');
    }

    public function su_admin_register_su_admin(){
        return view('Epm.SuAdmins.adm-register-su-admin');
    }

    public function su_admin_save(Request $request)
    {
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'gender' => ['required'],
                'email' => ['required', 'string', 'max:255', 'unique:users','regex:/\w+\.?\w+@\w+\.\w{2,3}(\.\w{2,3})?$/'],
                'phone' => ['required','regex:/^(\+254|0)\d{9}$/','unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
        $admin = new User();
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->phone = request('phone');
        $admin->gender = request('gender');
        $admin->is_admin = 1;
        $admin->password = Hash::make(request('password'));
        $admin->role_id = '';
        $role = new Role();
        $role->name = 'Su Admin';
        $role_exists = DB::table('roles')->where('name',$role->name)->first();
        if($role_exists){
            $admin->role_id = $role_exists->id;
        }else{
            $role->save();
            $admin->role_id = $role->id;
        }
        $admin->save();
        if ($admin){
            Auth::login($admin);
            return redirect('/adm/main/dashboard');
        }else{
            return redirect()->back()->withErrors('OOOps an error occurred please try again later');
        }
    }

    public function adm_save_su_admin(Request $request){
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'max:10', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
        $admin = new User();
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->phone = request('phone');
        $admin->is_admin = 1;
        $admin->password = Hash::make(request('password'));
        $admin->role_id = '';
        $role = DB::table('roles')->where('name','Su Admin')->first();
        if ($role){
            $admin->role_id = $role->id;
        }
        $admin->save();
        if ($admin){
            return redirect('/adm-dashboard');
        }
    }

    public function adm_profile_view($id){
        $admin = DB::table('users')->where('id',$id)->first();
        return view('Epm.SuAdmins.su-admin-profile-view',compact('admin'));
    }

    public function adm_profile_edit($id){
        $admin = DB::table('users')->where('id',$id)->first();
        return view('Epm.SuAdmins.su-admin-profile-edit',compact('admin'));
    }

    public function adm_profile_update(Request $request,$id){
        $data = '';
        if ($request->hasFile('image')){
            $fileName = '';
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('SuAdmins/images',$fileName);
            }
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'image'=>$fileName,
                'gender'=>$request->gender,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'bio'=>$request->bio,
            ];
        }else{
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'bio'=>$request->bio,
            ];
        }
        $user = DB::table('users')->where('id',$id)->update($data);
            return redirect('/adm/profile/'.$id)->with('success','Profile Updated Successfully');
    }

    /**
     * Project Managers
     **/

    public function pms()
    {
        $admin_user = Auth::user();
        $role = DB::table('roles')->where('name','Project Manager')->first();
        $project_managers = '';
        if ($role){
            $project_managers = User::orderBy('id','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.SuAdmins.PMs.list-pms',compact('project_managers','admin_user'));
    }

    public function pm_add()
    {
        return view('Epm.SuAdmins.PMs.add-pm');
    }


    public function delete_pm($id)
    {
        $admin_user_id = Auth::id();
        $admin_user = DB::table('users')->where('id',$admin_user_id)->first();
       DB::table('users')->where('id',$id)->delete();
        return redirect('/list-pms')->with('success','Project Manager deleted Successfully');
    }

    /**
     * Centers
     **/

    public function center_save(Request $request){
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'county' => ['required'],
                'location' => ['required'],
                'location_lat_long' => ['required'],
            ]
        );
        $center = new Center();
        $center->name = request('name');
        $center->county = request('county');
        $center->location = request('location');
        $center->location_lat_long = request('location_lat_long');
        $center_saved = $center->save();
        if ($center_saved) {
            $request->session()->flash('message', 'Successfully added Center');
            return redirect('/list-centers')->with('success', $request->session()->get('message'));
        }else{
            $request->session()->flash('message', 'An error occurred when trying to create Center please try again later');
            return redirect('/list-centers')->with('error', $request->session()->get('message'));
        }
    }


    public function centers(){
        $result = [];
        $centers = DB::table('centers')->get();
        foreach ($centers as $center){
            $result[]=$center;
        }
        return response()->json($result);
    }

    /**
     * Center Managers
     **/

    public function cms_list()
    {
        $admin_user = Auth::user();
        $center_managers = '';
        $role = DB::table('roles')->where('name','Center Manager')->first();
        if ($role){
            $center_managers = User::orderBy('created_at','desc')->where('role_id',$role->id)->get();}
        return view('Epm.SuAdmins.CMs.list-cms',compact('center_managers','admin_user'));
    }

    public function cm_add()
    {
        return view('Epm.SuAdmins.CMs.add-cm');
    }

    public function delete_cm($id)
    {
        $admin_user_id = Auth::id();
        $admin_user = DB::table('users')->where('id',$admin_user_id)->first();
        DB::table('users')->where('id',$id)->delete();
        return redirect('/list-cms')->with('success','Center Manager Deleted Successfully');
    }

    public function cms(){
        $role = DB::table('roles')->where('name','Center Manager')->first();
        $result = [];
        if ($role){
            $cms = DB::table('users')->where('role_id',$role->id)->get();
            if (!empty($cms)){
                foreach ($cms as $cm){
                    $result[]=$cm;
                }
            }
            return response()->json($result);
        }
    }

    public function cms_new($id){
        $added_cm_ids = json_decode(DB::table('team_cm_member')->where('team_id',$id)->pluck('center_manager_id'));
        $role = DB::table('roles')->where('name','Center Manager')->first();
        $cm_ids = '';
        if ($role){
            $cm_ids = json_decode(DB::table('users')->where('role_id',$role->id)->pluck('id'));
        }
        $cm_new_member_ids = [];
        foreach ($cm_ids as $cm_id){
            if (!in_array($cm_id,$added_cm_ids)){
                $cms = DB::table('users')->where('role_id',$role->id)->where('id',$cm_id)->get();
                foreach ($cms as $cm){
                    $cm_new_member_ids[] = $cm;
                }
            }
        }
        return response()->json($cm_new_member_ids);
    }

    /**
     * Trainers
     **/

    public function trainers_list()
    {
        $admin_user = Auth::user();
        $trainers='';
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = User::orderBy('created_at','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.SuAdmins.Trainers.list-trainers',compact('trainers','admin_user'));
    }

    public function delete_trainer(Request $request,$id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('/list-trainers')->with('success','Trainer Deleted Successfully');
    }

    public function trainer_add()
    {
        return view('Epm.SuAdmins.Trainers.add-trainer');
    }


    public function trainers_team_new($id){
        $added_trainers_ids = json_decode(DB::table('team_trainer_member')->where('team_id',$id)->pluck('trainer_id'));
        $role = DB::table('roles')->where('name','Trainer')->first();
        $trainer_ids = '';
        if ($role){
            $trainers_ids = json_decode(DB::table('users')->where('role_id',$role->id)->pluck('id'));
        }
        $trainers_new_member_ids = [];
        foreach ($trainers_ids as $trainer_id){
            if (!in_array($trainer_id,$added_trainers_ids)){
                $trainers = DB::table('users')->where('role_id',$role->id)->where('id',$trainer_id)->get();
                foreach ($trainers as $trainer){
                    $trainers_new_member_ids[] = $trainer;
                }
            }
        }
        return response()->json($trainers_new_member_ids);
    }

    /**
     * Mentors
     **/

    public function mentors_list()
    {
        $mentors = '';
        $role = DB::table('roles')->where('name','Mentor')->first();
        if ($role){
            $mentors = DB::table('users')->where('role_id',$role->id)->get();
        }
        return view('Epm.SuAdmins.Mentors.list-mentors',compact('mentors'));
    }

    public function mentor_add()
    {
        return view('Epm.SuAdmins.Mentors.add-mentor');
    }

    /**
     * Sessions
     **/

    public function view_class($id,$class_id){
        $admin = User::find($id);
//        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){{}
        return view('Epm.Classes.view-class');

    }



//    public function new_session_trainers($id){
//        $added_trainers_ids = json_decode(DB::table('trainer_training_session')->where('training_session_id',$id)->get());
//        $role = DB::table('roles')->where('name','Trainer')->first();
//        $trainer_ids = '';
//        if ($role){
//            $trainers_ids = json_decode(DB::table('users')->where('role_id',$role->id)->pluck('id'));
//        }
//        $trainers_new_member_ids = [];
//        foreach ($trainers_ids as $trainer_id){
//            if (!in_array($trainer_id,$added_trainers_ids)){
//                $trainers = DB::table('users')->where('role_id',$role->id)->where('id',$trainer_id)->get();
//                foreach ($trainers as $trainer){
//                    $trainers_new_member_ids[] = $trainer;
//                }
//            }
//        }
//        return response()->json($trainers_new_member_ids);
//    }


    /**
     * Teams (Team Trainers)
    **/

    public function team_trainers_list(){
        $teams = DB::table('team_trainers')->get();
        return view('Epm.SuAdmins.Teams.team-trainers',compact('teams'));
    }

    public function team_trainers_add(){
        $trainers = '';

        $role = DB::table('roles')->where('name','Trainer')->first();

        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get();
        }
        return view('Epm.Teams.add-team-trainers',compact('trainers'));
    }

    public function team_trainers_save(Request $request,$id){
        $admin = User::find($id);
        $trainers_team = new TeamTrainer();
        $trainers_team->name = $request->name;
        $trainers_team->description = $request->about;;
        $team_leaders = $request->input('team_leader_ids');
        $trainers_team->creator_id = Auth::id();
        $new_team_created = $trainers_team->save();
        if ($new_team_created){
            $saved_team = TeamTrainer::find($trainers_team->id);
            $team_leader_ids = [];
            foreach ($team_leaders as $team_leader){
                $team_leader_ids[] = [
                  'team_leader_id'=>$team_leader,
                  'team_id'=>$saved_team->id,
                ];
            }
            $saved_team->trainers()->attach($team_leaders);
            DB::table('team_trainer_leaders')->insert($team_leader_ids);
        }
        return redirect('/adm/'.$admin->id.'/list/team/trainers');
    }
    public function team_trainer_members_add($id,$team_id){
        $team = DB::table('team_trainers')->where('id',$team_id)->first();
        return view('Epm.Teams.add-team-trainer-member',compact('team'));
    }

    public function team_trainer_members_save(Request $request,$id,$team_id){
        $admin = User::find($id);
        $trainer_team_member_s_id = $request->trainer_team_member_s_id;
        $trainer_team = TeamTrainer::find($team_id);
        $trainer_team->trainers()->attach($trainer_team_member_s_id);
        return redirect('/adm/'.$admin->id.'/list/team/trainers')->with('success','Trainer(s) Successfully added to team');
    }

    /**
     * Teams (Team Center Managers)
     **/


    public function team_cms(){
        $teams = DB::table('team_center_managers')->get();
       return response()->json($teams);
    }


    /**
     * Ajira Clubs
     **/

    public function ajira_clubs(){
        return view('Epm.SuAdmins.Ajira.list-clubs');
    }


}
