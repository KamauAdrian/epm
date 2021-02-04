<?php

namespace App\Http\Controllers;

use App\Exports\TraineesTemplateExport;
use App\Exports\TrainersTemplateExport;
use App\Http\Middleware\CenterManager;
use App\Imports\TraineesImport;
use App\Imports\TrainersImport;
use App\Mail\CreatePassword;
use App\Mail\ForgotPassword;
use App\Mail\WelcomeMail;
use App\Models\Center;
use App\Models\EmployeeLeaveApplication;
use App\Models\ProjectManager;
use App\Models\Report;
use App\Models\ReportActivity;
use App\Models\ReportQuestion;
use App\Models\ReportReport;
use App\Models\ReportTemplate;
use App\Models\Role;
use App\Models\TeamCenterManager;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\TrainingSession;
use App\Models\User;
use Carbon\Carbon;
use Faker\Calculator\Iban;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\New_;
use function PHPUnit\Framework\never;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        return view('Epm.admin-login');
//        return view('Epm.Layouts.adm-dashboard');
    }

    public function index()
    {
        return view('Epm.layouts.adm-dashboard');
    }
    public function dashboard_actors(){
        $result = [];
        $roles = DB::table('roles')->get();
        foreach ($roles as $role){
            $result[] = ['x'=>$role->name,'y'=>count(User::where('role_id',$role->id)->get())];
        }
        return response()->json($result);
    }
    public function dashboard_pms(){
        $role = DB::table('roles')->where('name','Project Manager')->first();
        $result = [];
        if ($role){
            $pms = DB::table('users')->where('role_id',$role->id)->get()->groupBy('department');
            foreach ($pms as $key=>$pm){
                $result[] = ['x'=>$key,'y'=>count($pm)];
            }
        }
        return response()->json($result);
    }
    public function dashboard_centers(){
        $centers = Center::all();
        $result = [];
        foreach ($centers as $center){
            $cms = Center::find($center->id)->centerManagers;
            $result[] = ['x'=>$center->name,'y'=>count($cms)];
        }
        return response()->json($result);
    }
    public function dashboard_cms(){
        $role = DB::table('roles')->where('name','Center Manager')->first();
        $result = [];
        if ($role){
            $cms = DB::table('users')->where('role_id',$role->id)->get()->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('M');
            });
            foreach ($cms as $key=>$cm){
                $result[] = ['x'=>$key,'y'=>count($cm)];
            }
        }
        return response()->json($result);
    }
    public function dashboard_trainers(){
        $role = DB::table('roles')->where('name','Trainer')->first();
        $result = [];
        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get()->groupBy('speciality');
            foreach ($trainers as $key=>$trainer){
                $result[] = ['x'=>$key,'y'=>count($trainer)];
            }
        }
        return response()->json($result);
    }

    public function dashboard_sessions(){
        $result = [];
        $sessions = DB::table('training_sessions')->get()->groupBy('category');
        foreach ($sessions as $key=>$session){
            $result[] = ['x'=>$key,'y'=>count($session)];
        }
        return response()->json($result);
    }
    public function dashboard_trainees(){
        $trainees = Trainee::all()->groupBy(function($val) {
            return Carbon::parse($val->created_at)->format('M Y');
        });
        $result = [];
        foreach ($trainees as $key=>$trainee){
            $result[] = ['x'=>$key,'y'=>count($trainee)];
        }
        return response()->json($result);
    }

    public function adms_list($role_id)
    {
        $auth_admin = Auth::user();
        $role = DB::table('roles')->where('id',$role_id)->first();
        $admins = User::orderBy('name')->where('role_id',$role_id)->get();
        return view('Epm.list-admins',compact('admins','role'));
    }

    public function trainees_list($id)
    {
        $auth_admin = Auth::user();
        $trainees = Trainee::orderBy('id','desc')->get();
        return view('Epm.Trainees.trainees',compact('trainees'));
    }

    public function add_admin($id,$role){
        if ($role == 'Project Manager'){
            return view('Epm.PMs.add-pm');
        }
        elseif ($role == 'Center Manager'){
            return view('Epm.CMs.add-cm');
        }
        elseif ($role == 'Trainer'){
            return view('Epm.Trainers.add-trainer');
        }
        elseif ($role == 'Mentor'){
            return view('Epm.Mentors.add-mentor');
        }
    }

    public function view_adm_profile($id)
    {
        $admin = DB::table('users')->where('id',$id)->first();
        return view('Epm.view-admin-profile',compact('admin'));
    }
    public function view_logged_in_adm_profile($id,$role_id)
    {
        $auth_adm= Auth::user();
        if ($auth_adm->role->id == $role_id && $auth_adm->id ==$id){
            $admin = DB::table('users')->where('id',$id)->first();
            return view('Epm.auth-admin-profile',compact('admin'));
        }else{
            return redirect('/');
        }
    }

    public function edit_adm_profile($id){
        $auth_admin = Auth::user();
        $admin = DB::table('users')->where('id',$id)->first();
        return view('Epm.edit-admin-profile',compact('admin'));
    }

    public function adm_profile_update(Request $request,$id)
    {
        $admin = User::find($id);
        $data = '';
        if ($request->hasFile('image')){
            $fileName = '';
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                if ($admin->role->name == 'Su Admin'){
                    $image->move('SuAdmins/images',$fileName);
                }elseif ($admin->role->name == 'Project Manager'){
                    $image->move('ProjectManagers/images',$fileName);
                }elseif ($admin->role->name == 'Center Manager'){
                    $image->move('CenterManagers/images',$fileName);
                }elseif ($admin->role->name == 'Trainer'){
                    $image->move('Trainers/images',$fileName);
                }elseif ($admin->role->name == 'Mentor'){
                    $image->move('Mentors/images',$fileName);
                }
            }
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'bio'=>$request->bio,
                'image'=>$fileName,
                'center_id'=>$request->center_id,
                'department'=>$request->department,
                'speciality'=>$request->speciality,
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
                'center_id'=>$request->center_id,
                'department'=>$request->department,
                'speciality'=>$request->speciality,
            ];
        }
        $admin_user = \auth()->user();
        $updated = User::updateUser($id,$data);
        $auth_admin = Auth::user();
        if ($auth_admin->id == $id){
            return redirect('/adm/'.$id.'/profile/public/role_id='.$admin->role->id.'/view')->with('success','Profile Updated Successfully');
        }else{
            return redirect('/adm/view/adm/'.$id.'/profile/role_id='.$admin->role->id)->with('success','Profile Updated Successfully');
        }
    }

    public function adm_delete($id,$role_id)
    {
        $admin_user_id = Auth::id();
        $admin_user = DB::table('users')->where('id',$admin_user_id)->first();
        DB::table('users')->where('id',$id)->delete();
        return redirect('/list/all/admins/role_id='.$role_id)->with('success','Admin deleted Successfully');
    }

    //log in all admins
    public function admin_login(Request $request)
    {
        $admin_info = $request->all();
        $user_exists = DB::table('users')->where('email',$admin_info['email'])->first();
        if ($user_exists){
            $result = Auth::attempt(['email'=>$admin_info['email'],'password'=>$admin_info['password']]);
            if ($result){
                return redirect('/adm/main/dashboard');
            }else{
                $request->session()->flash('error','Password error');
                return redirect()->back()->with('message',$request->session()->get('error'));
            }
        }
        $email = $admin_info['email'];
        $request->session()->flash('failed','Oooops no record for '.$email.' found');
        return redirect()->back()->with('error',$request->session()->get('failed'));
    }

    public function admin_logout(){
        Auth::logout();
        return redirect('/');
    }

    public function activate_account($id){
        $admin_user = DB::table('users')->where('id',$id)->first();
        return view('Epm.create-password',compact('admin_user'));
    }

    public function update_account(Request $request,$id){
        $this->validate($request,[
            'password'=>['required','confirmed'],
        ]);
        $password = Hash::make($request->password);
        $data = [
            'password'=>$password,
            ];
        $updated = User::updateUser($id,$data);
        $request->session()->flash('message','Account activation success please login with your email address and password to continue');
        return redirect('/')->with('success',$request->session()->get('message'));

    }

    public function forgot_password(){
        return view('Epm.forgot-password');
    }
    public function request_reset_password(Request $request){
        $email = $request->email;
        $adm_user = DB::table('users')->where('email',$email)->first();
        $reset_password_session_verification = Hash::make(rand(10001,121345678));
        date_default_timezone_set("Africa/Nairobi");
        $created_at = date('Y-m-d H:i:s');
        $request->session()->flash('not_adm_user','Sorry Email Address not found');
        $request->session()->flash('success_message','Success we emailed you instructions to reset your password check your inbox and create a new password');
        if ($adm_user){
            $data = [
                'user_id'=>$adm_user->id,
                'session_verification'=>$reset_password_session_verification,
                'name'=>$adm_user->name,
            ];
            $password_reset = [
                'email'=>$adm_user->email,
                'token'=>$reset_password_session_verification,
                'created_at'=>$created_at,
            ];
            DB::table('password_resets')->insert($password_reset);
            Mail::to($email)->send(new ForgotPassword($data));
            return redirect('/')->with('success',$request->session()->get('success_message'));
        }else{
            return redirect('/')->with('error',$request->session()->get('not_adm_user'));
        }
    }

    public function reset_password($token,$id){
        $admin_user = DB::table('users')->where('id',$id)->first();
        $genuine_request = DB::table('password_resets')->where('email',$admin_user->email)->orderBy('created_at','desc')->first();
        if ($genuine_request) {
            date_default_timezone_set("Africa/Nairobi");
            $date_time_now = strtotime(date('Y-m-d H:i:s'));
            $date_time_request = strtotime($genuine_request->created_at);
            $time_diff = $date_time_now - $date_time_request;
            $split_token = explode('/', $genuine_request->token);
            $confirm_token = '';
            if (count($split_token) > 1) {
                $confirm_token = $split_token[0];
            } else {
                $confirm_token = $genuine_request->token;
            }
//        dd($genuine_request->token,$confirm_token,$time_diff,$date_time_now,$date_time_request);
            if ($token == $confirm_token && $time_diff <= 300) {
                return view('Epm.reset-password', compact('admin_user'));
            } else {
                return redirect('/')->with('error', 'Sorry reset Password Page expired please try again later');
            }
        }else{
            return redirect('/');
        }

    }

    public function update_password(Request $request,$id){
        $this->validate($request,[
            'password'=>['required','confirmed'],
        ]);
        $password = Hash::make($request->password);
        $data = [
            'password'=>$password,
        ];
       User::updateUser($id,$data);
        $request->session()->flash('message','Password changed successfully please login to continue');
        return redirect('/')->with('success',$request->session()->get('message'));

    }

    public function employee_leave_form($id){
        if (Auth::user()->id == $id){
            return view('Epm.Forms.leave-form');
        }
    }

    public function employee_leave_applications($id){
        if (Auth::user()->id == $id){
            $applications = EmployeeLeaveApplication::where('applicant_id',$id)->get();
            return view('Epm.Forms.leave-applications');
        }
    }

    public function employee_leave_application($id,$application_id){
        if (Auth::user()->id == $id){
            $application = EmployeeLeaveApplication::find($application_id);
            return view('Epm.Trainers.leave-application',compact('application'));
        }
    }

    public function trainer_leave_applications($id){
        if (Auth::user()->id == $id){
            $applications = EmployeeLeaveApplication::where('applicant_id',$id)->get();
            return view('Epm.Trainers.leave-applications',compact('applications'));
        }
    }

    public function adm_view_trainer_leave_applications($id){
        if (Auth::user()->id == $id){
            $applications = EmployeeLeaveApplication::orderBy('created_at','desc')->get();
            return view('Epm.Trainers.leave-applications',compact('applications'));
        }
    }

    public function employee_leave_request(Request $request, $id){
        $messeges = [
            'leave_type.required'=>'Please select the leave type your are taking'
        ];
        $this->validate($request,[
            'leave_type'=>['required'],
        ],$messeges);
        $leave_applicant = User::find($id);
        $leave_application = new EmployeeLeaveApplication();
        //applicant info
        $leave_application->applicant_name = $leave_applicant->name;
        $leave_application->applicant_id = $leave_applicant->id;
        $leave_application->applicant_email = $leave_applicant->email;
        $leave_application->applicant_phone = $leave_applicant->phone;
        $leave_application->applicant_employee_number = $leave_applicant->employee_number;
        $leave_application->application_date = $request->application_date;
        $leave_application->leave_days = $request->leave_days;
        $leave_application->other_leave_type = $request->other_leave_type;
        $leave_application->leave_first_day = $request->leave_first_day;
        $leave_application->leave_last_day = $request->leave_last_day;
        $leave_application->applicant_duty_station = $request->applicant_duty_station;
        $leave_application->applicant_maternity_leave_due_date = $request->applicant_maternity_leave_due_date;
        //proof of sick off or study leave file upload (doctors note or exam timetable)
        $fileName = '';
        if ($request->hasFile('applicant_sick_off_study_leave_proof')){
            $image = $request->file('applicant_sick_off_study_leave_proof');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
            }
            $image->move('LeaveApplications/Proof',$fileName);
        }
        $leave_application->applicant_sick_off_study_leave_proof = $fileName;
        //colleague info (to take over responsibility)
        $leave_application->colleague_name = $request->colleague_name;
        $leave_application->colleague_email = $request->colleague_email;
        $leave_application->colleague_phone = $request->colleague_phone;
        $leave_application->colleague_designation = $request->colleague_designation;
        $leave_application->colleague_duty_station = $request->colleague_duty_station;
        $leave_application->next_of_kin_name = $request->next_of_kin_name;
        $leave_application->next_of_kin_email = $request->next_of_kin_email;
        $leave_application->next_of_kin_phone = $request->next_of_kin_phone;
        $leave_application->general_comment_concern = $request->general_comment_concern;

        $leave_application->save();

        return redirect('/adm/'.$id.'/view/leave/applications')->with('success','leave Application Success');

    }
//Reports
    public function reports_templates($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $templates = DB::table('report_templates')->orderBy('created_at','desc')->get();
            return view('Epm.Reports.templates',compact('templates'));
        }
    }

    public function report_create($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            return view('Epm.Reports.report-add');
        }
    }

    public function report_save(Request $request,$id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $this->validate($request,[
                'name'=>'required',
                'target_groups'=>'required',
            ]);
            $report = new Report();
            $report->name = $request->name;
            $data = $request->target_groups;
            $created = $report->save();
            if ($created){
                Report::find($report->id)->groups()->attach($data);
            }
            return redirect('/adm/'.$id.'/view/reports');
        }
    }

    public function report_actors(){
        $result = [];
        $actors = DB::table('roles')->get();
        if (!empty($actors)){
            foreach ($actors as $actor){
                $result[]=$actor;
            }
        }
        return response()->json($result);
    }

    public function report_actors_pmos(){
        $result = [];
        $role = DB::table('roles')->where('name','Project Manager')->first();
        if ($role){
            $pmos = DB::table('users')->where('role_id',$role->id)->get();
            if (!empty($pmos)){
                foreach ($pmos as $pmo){
                    $result[]=$pmo;
                }
            }
        }
        return response()->json($result);
    }

    public function report_template_create($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            return view('Epm.Reports.template-create');
        }
    }
    public function report_template_create_pmo($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin'){
            return view('Epm.Reports.template-create-pmo');
        }
    }

    public function report_template_generate(Request $request,$id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            //validate the request
//            $this->validate($request,[
//                'name'=>'required',
//                'required_fields'=>'required',
//                'questions'=>'required',
//                'target_groups'=>'required',
//            ]);
            //create a new report template(add questions to a report)
            $report_template = new ReportTemplate();
            $report_template->name = $request->name;
            $target_groups = $request->target_groups;
            //option one for required fields
            $required_fields = $request->required_fields;
            $report_questions = $request->questions;
            $questions = [];
            $template_generated = $report_template->save();
            if ($template_generated){
                $existing_template = ReportTemplate::find($report_template->id);
                if ($existing_template && $target_groups){
                    $groups = [];
                    foreach ($target_groups as $target_group){
                        $groups[] = [
                            'report_template_id'=>$existing_template->id,
                            'target_group_id'=>$target_group
                        ];

                    }
                    $existing_template->groups()->attach($target_groups);
                }
                if ($existing_template && $report_questions){
                    $questions = [];
                    foreach ($report_questions as $report_question){
                        $questions[] = [
                            'question'=>$report_question,
                            'report_template_id'=>$existing_template->id,
                        ];
                    }
                    DB::table('report_questions')->insert($questions);
                }
                if ($existing_template && $required_fields){
                    $fields = [];
                    foreach ($required_fields as $required_field){
                        $fields[] = [
                            'name'=>$required_field,
                            'report_template_id'=>$existing_template->id,
                        ];
                    }
                    DB::table('report_template_fields')->insert($fields);
                }
            }
            return redirect('/adm/'.$id.'/view/reports/template')->with('success','Report Template Created successfully');
        }
    }

    public function report_template_generate_pmos(Request $request,$id){
        dd($request->all());
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            //validate the request
//            $this->validate($request,[
//                'name'=>'required',
//                'required_fields'=>'required',
//                'questions'=>'required',
//                'target_groups'=>'required',
//            ]);
            //create a new report template(add questions to a report)
            $report_template = new ReportTemplate();
            $report_template->name = $request->name;
            $pms = $request->target_groups;
            //option one for required fields
            $report_questions = $request->questions;
            $questions = [];
            $template_generated = $report_template->save();
//            return redirect('/adm/'.$id.'/view/reports/template')->with('success','Report Template Created successfully');
        }
    }

    public function report_template_view($id,$template_id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $template = ReportTemplate::find($template_id);
            return view('Epm.Reports.view-template',compact('template'));
        }
    }

    public function report_template_edit($id,$template_id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $template = ReportTemplate::find($template_id);
            return view('Epm.Reports.edit-template',compact('template'));
        }
    }

    public function reports($id,$report_id){
        //get all reports submitted using report_id
        $reports = DB::table('reports')->orderBy('created_at','desc')->where('report_template_id',$report_id)->where('user_id',$id)->get();
        $template = ReportTemplate::find($report_id);
        return view('Epm.Reports.reports',compact('reports','template'));

    }
    public function view_reports_by_key($id,$template_id,$target_group_id,$key){
        //get all reports submitted using report_id
        $admin = Auth::user();
        $role = Role::find($target_group_id);
        if ($admin->id == $id) {
            $reports_raw = DB::table('reports')
                ->where('report_template_id',$template_id)
                ->where('report_target_group_id',$target_group_id)->get()
                ->groupBy(function ($val){return Carbon::parse($val->created_at)->format('M Y W');});
            $reports = $reports_raw[$key];
//            $report = DB::table('reports')->where('id', $report_id)->first();
            $template = ReportTemplate::find($template_id);
            $key_name = $key;
            return view('Epm.Reports.reports-by-key-list', compact('reports', 'template','role','key_name'));
//            return view('Epm.Reports.view-report', compact('report', 'template'));
        }
    }
    public function view_report($id,$template_id,$report_id){
        //get all reports submitted using report_id
        $admin = Auth::user();
        if ($admin->id == $id) {
            $report = DB::table('reports')->where('id', $report_id)->first();
            $template = ReportTemplate::find($template_id);
            return view('Epm.Reports.view-report', compact('report', 'template'));
        }
    }

    public function submit_report($id,$report_id)
    {
//        $report = DB::table('report_templates')->where('id',$report_id)->first();
        $report = ReportTemplate::find($report_id);

        return view('Epm.Reports.submit-report',compact('report'));
    }

    public function save_report(Request $request,$id,$report_id)
    {
        $admin = User::find($id);
        $template = ReportTemplate::find($report_id);
        $request_names = [];
        $report_target_groups = [];
        $report_questions = [];
        foreach ($template->groups as $group){
            $report_target_groups[] = $group->id;
        }
        if (in_array($admin->role->id,$report_target_groups)){
            foreach ($template->questions as $question){
                $report_questions[] = ['id'=>$question->id,'question'=>$question->question];
                $request_names[] = "reports_".$question->id."_quest";
            }
            $new_report = new Report();
            $new_report->name = $request->name;
            $new_report->user_id = $admin->id;
            $new_report->report_target_group_id = $admin->role->id;
            $new_report->report_template_id = $request->report_template_id;
            $new_report->employee_number = $request->employee_number;
            $new_report->date_of_report = $request->date_of_report;
            $new_report->role = $request->role;
            $new_report->duty_station = $request->duty_station;
            $report_activities = null;
            $reports_all = null;
            $activities = $request->activity;
            $reports = request($request_names);
            $keys_reports = array_keys($reports);
            extract($reports);
            $total_reports = count($reports);
            $saved_report = $new_report->save();
            if ($saved_report){
                foreach ($activities as $value) {
                    $new_activity = new ReportActivity();
                    $new_activity->name = $value;
                    $new_activity->report_id = $new_report->id;
                    $saved_activity = $new_activity->save();
                    $report_activities[] = $new_activity->id;
                }
                if ($saved_activity){
                    for ($i=0;$i<$total_reports;$i++) {
                        $x = $keys_reports[$i];
                        foreach ($$x as $key=>$value) {
                            $new_report_report = new ReportReport();
                            $q_id = explode('_', $x);
                            $new_report_report->report = $value;
                            $new_report_report->report_id = $new_report->id;
                            $new_report_report->question_id = $q_id[1];
                            $new_report_report->activity_id = $report_activities[$key];
                            $saved_report_report = $new_report_report->save();
                        }
                    }
                    if ($saved_report_report){
                        return redirect('/adm/'.$id.'/view/reports/template_id='.$report_id)->with('success','Successfully Submitted report');
                    }
                }
            }
        }else{
            return redirect()->back()->with('error','Error Not authorized to submit this report');
        }
    }

    public function reports_by_role($id,$target_group_id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $report_target_group = Role::find($target_group_id);
            $templates = $report_target_group->templates;
            return view('Epm.Reports.reports-by-role',compact('report_target_group','templates'));
        }
    }

    public function reports_by_role_list($id,$template_id,$report_target_group_id){
        $role = Role::find($report_target_group_id);
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $reports = DB::table('reports')
                ->where('report_template_id',$template_id)
                ->where('report_target_group_id',$report_target_group_id)->get()
                ->groupBy(function ($val){return Carbon::parse($val->created_at)->format('M Y W');});
            $template = ReportTemplate::find($template_id);
            return view('Epm.Reports.reports-by-role-list',compact('reports','template','role'));
        }
    }

    public function reports_by_trainers($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            return view('Epm.Reports.trainer-reports');
        }
    }
    public function session_allocations($id){
        $today = date('Y-m-d');
//        $sessions = DB::table('training_sessions')->orderBy('created_at','desc')->get()->groupBy('date');
        $sessions = TrainingSession::orderBy('created_at','desc')->get()->groupBy('date');
//        dd($sessions);
//        $sessions = DB::table('training_sessions')->orderBy('created_at','desc')->where('date',$today)->get();
        return view('Epm.Trainers.training-sessions-allocations',compact('sessions'));
    }
    public function reports_by_trainers_attendance($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $reports = DB::table('trainer_daily_attendance_reports')->orderBy('created_at','desc')->get();
            return view('Epm.Reports.trainer-daily-attendance-reports',compact('reports'));
        }
    }

    public function reports_by_trainers_virtual($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $reports = DB::table('trainer_daily_virtual_training_reports')->orderBy('created_at','desc')->get();
            return view('Epm.Reports.trainer-daily-virtual-training-reports',compact('reports'));
        }
    }

    public function reports_by_trainers_physical($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $reports = DB::table('trainer_daily_physical_training_reports')->orderBy('created_at','desc')->get();
            return view('Epm.Reports.trainer-daily-physical-training-reports',compact('reports'));
        }
    }

    public function reports_by_trainers_assignment($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $reports = DB::table('trainer_assignment_submission_reports')->orderBy('created_at','desc')->get();
            return view('Epm.Reports.trainer-assignment-submission-reports',compact('reports'));
        }
    }

//centers
    public function center_add(){
        return view('Epm.Centers.add-center');
    }

    public function center_save(Request $request){
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'county' => ['required'],
                'location' => ['required'],
            ]
        );
        $center = new Center();
        $center->name = request('name');
        $center->county = request('county');
        $center->location = request('location');
        $center->location_lat_long = request('location_lat_long');
        $center_saved = $center->save();
        if ($center_saved) {
            $request->session()->flash('message', 'Center Added Successfully');
            return redirect('/adm/list/centers')->with('success', $request->session()->get('message'));
        }else{
            $request->session()->flash('message', 'An error occurred when trying to create Center please try again later');
            return redirect('/adm/list/centers')->with('error', $request->session()->get('message'));
        }
    }

    public function centers_list(){
        $centers = Center::orderBy('created_at','desc')->get();
        return view('Epm.Centers.centers',compact('centers'));
    }

    public function view_center($id,$center_id){
        $center = DB::table('centers')->where('id',$center_id)->first();
        return view('Epm.Centers.view-center',compact('center'));
    }

    public function edit_center($id){
        $center = DB::table('centers')->where('id',$id)->first();
        return view('Epm.Centers.edit-center',compact('center'));
    }

    public function update_center(Request $request,$id){
        $data = [];
        if ($request->hasFile('image')){
            $fileName = '';
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('Centers/images',$fileName);
            }
            $data = [
                'name'=>$request->name,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'image'=>$fileName,
                'description'=>$request->description,
            ];
        }else{
            $data = [
                'name'=>$request->name,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'description'=>$request->description,
            ];
        }
        $updated = DB::table('centers')->where('id',$id)->update($data);
        return redirect('/adm/view/center/'.$id)->with('success','Center Updated Successfully');
    }

    public function delete_center(Request $request,$id){
        $data = [
            'center_id'=>null,
        ];
        $cms_in_center = DB::table('users')->where('center_id',$id)->update($data);

        DB::table('centers')->where('id',$id)->delete();

        return redirect('/adm/list/centers')->with('success','Center Deleted Successfully');
    }


    public function cm_save(Request $request)
    {
        $messages = [
            'phone.regex' => 'Invalid Phone number format',
        ];

        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'unique:users','regex:/\w+\.?\w+@\w+\.\w{2,3}(\.\w{2,3})?$/'],
                'phone' => ['required','regex:/^(\+254|0)\d{9}$/','unique:users'],
                'gender' => ['required'],
                'employee_number' => ['required','unique:users'],
                'county' => ['required'],
            ],$messages
        );

$admin_user = Auth::user();
        // first create the center manager role
        $role = new Role();
        $role->name ='Center Manager';
        //check if role exists
        $role_exists = DB::table('roles')->where('name',$role->name)->first();
//create a center manager as admin user with center manager role (add to users table)
        $cm_user = new User();
        $update_center= [];
        $center='';
        $cm_user->name = $request->name;
        $cm_user->gender = $request->gender;
        $cm_user->email = $request->email;
        $email = $cm_user->email;
        $cm_user->phone = '';
        $phone = $request->phone;
        $country_code = substr($phone,0,4);
        if ($country_code == +254){
            $minus_code = substr($phone,4,strlen($phone));
            $new_phone = '0'.$minus_code;
            $cm_user->phone = $new_phone;
        }else{
            $cm_user->phone = $phone;
        }
        $cm_user->employee_number = $request->employee_number;
        $cm_user->county = $request->county;
        $cm_user->center_id = $request->center_id;
        $cm_user->bio = $request->bio;
        if ($cm_user->center_id){
            $center = DB::table('centers')->where('id',$cm_user->center_id);
        }
        $cm_user->is_admin = 1;
        $cm_user->role_id = '';
// if role exists add existing role id to the admin user role_id
        if ($role_exists){
            $cm_user->role_id = $role_exists->id;
        }else{
// if not exist save the new role
            $role_saved = $role->save();
//assign admin user the new role
            $cm_user->role_id = $role->id;
        }
        if ($request->hasFile('image')){
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('CenterManagers/images',$fileName);
                $cm_user->image = $fileName;
            }
        }
        $new_cm = $cm_user->save();
        if ($new_cm){
            $data = [
                'user_id'=>$cm_user->id,
                'name'=>$cm_user->name,
                'email'=>$cm_user->email,
                'phone'=>$cm_user->phone,
            ];
            Mail::to($email)->send(new CreatePassword($data));
        }
    //redirect to center managers list page with success messages
        $request->session()->flash('success_message','Center Manager created successfully');
    if ($new_cm){
        return redirect('/list/all/admins/role_id='.$cm_user->role_id)->with('success',$request->session()->get('success_message'));
    }

    }

    public function request_upload_trainers($id){
        return view('Epm.Trainers.upload-trainers');
    }
    public function download_trainers_excel_template()
    {
        return Excel::download(new TrainersTemplateExport(), 'trainers.xlsx');
    }

    public function upload_trainers(Request $request,$id){
        $messages = [
            'trainers.required'=>'Please Select trainers Excel File to Upload',
        ];
        $this->validate($request,[
            'trainers'=>'required',
        ],$messages);
        $trainers_excel = Excel::toArray(new TrainersImport(), $request->file('trainers'));
        $trainers_raw = [];
        foreach ($trainers_excel as $trainer_excel){
            $trainers_raw[] = $trainer_excel;
        }
        $trainers = array_slice($trainers_raw[0],1);
        $role = new Role();
        $new_trainer_role = '';
        $role->name = 'Trainer';
        //check if role already created
        $exists_role = DB::table('roles')->where('name',$role->name)->first();
        if ($exists_role){
            $new_trainer_role = $exists_role->id;
        }else{
            $role->save();
            $new_trainer_role= $role->id;
        }
        foreach ($trainers as $trainer){
            $new_trainer = new User();
            $new_trainer->name =$trainer[0];
            $new_trainer->employee_number = $trainer[1];
            $new_trainer->email = $trainer[2];
            $new_trainer->phone = $trainer[3];
            $new_trainer->gender=$trainer[4];
            $new_trainer->county=$trainer[5];
            $new_trainer->is_admin=1;
            $new_trainer->role_id=$new_trainer_role;
            $saved_trainer = $new_trainer->save();
            if ($saved_trainer){
                $data = [
                    'user_id'=>$new_trainer->id,
                    'name'=>$new_trainer->name,
                    'email'=>$new_trainer->email,
                    'phone'=>$new_trainer->phone,
                ];
                Mail::to($new_trainer->email)->send(new CreatePassword($data));
            }
        }
        return redirect('/list/all/admins/role_id='.$new_trainer_role)->with('success','Trainers uploaded Successfully');
    }

    public function trainer_save(Request $request)
    {
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'unique:users','regex:/\w+\.?\w+@\w+\.\w{2,3}(\.\w{2,3})?$/'],
                'phone' => ['required','regex:/^(\+254|0)\d{9}$/','unique:users'],
                'gender' => ['required'],
                'employee_number' => ['required','unique:users'],
                'county' => ['required'],
                'location' => ['required'],
                'start_date' => ['required'],
            ]
        );
//        dd($request->all());
    $admin_user = Auth::user();
        //create trainer as admin user
        $trainer_adm_user = new User();
        $trainer_adm_user->name = request('name');
        $trainer_adm_user->email = request('email');
        $email = $trainer_adm_user->email;//used to send account activation email
        $trainer_adm_user->phone = request('phone');
        $trainer_adm_user->gender = request('gender');
        $trainer_adm_user->employee_number = request('employee_number');
        $trainer_adm_user->county = request('county');
        $trainer_adm_user->location = request('location');
        $trainer_adm_user->location_lat_long = request('event-location');
        $trainer_adm_user->start_date = request('start_date');
        $trainer_adm_user->is_admin = 1;
        $trainer_adm_user->role_id = '';
        $trainer_adm_user->speciality = $request->speciality;
        $trainer_adm_user->office_supplies = $request->office_supplies;
        $trainer_adm_user->laptop_type = $request->laptop_type;
        $trainer_adm_user->laptop_serial_number = $request->laptop_serial_number;
        $trainer_adm_user->bio = $request->bio;
        //before saving a user create a new role(Trainer) save the role and assign user to role_id
        $role = new Role();
        $role->name = 'Trainer';
        //check if role already created
        $exists_role = DB::table('roles')->where('name',$role->name)->first();
        if ($exists_role){
            $trainer_adm_user->role_id = $exists_role->id;
        }else{
            $role->save();
            $trainer_adm_user->role_id = $role->id;
        }
        if ($request->hasFile('image')){
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('Trainers/images',$fileName);
                $trainer_adm_user->image = $fileName;
            }
        }
        //save trainer admin user
        $trainer_adm_user_saved = $trainer_adm_user->save();
        if ($trainer_adm_user_saved){
            $data = [
                'user_id'=>$trainer_adm_user->id,
                'name'=>$trainer_adm_user->name,
                'email'=>$trainer_adm_user->email,
                'phone'=>$trainer_adm_user->phone,
            ];
            Mail::to($email)->send(new CreatePassword($data));
        }

//redirect to trainers list as per role
        $request->session()->flash('success_message','Trainer created Successfully');
            if ($trainer_adm_user_saved){
                return redirect('/list/all/admins/role_id='.$trainer_adm_user->role_id)->with('success',$request->session()->get('success_message'));
            }
    }

    public function trainers(){
        $role = DB::table('roles')->where('name','Trainer')->first();
        $result = [];
        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get();
            if (!empty($trainers)){
                foreach ($trainers as $trainer){
                    $result[]=$trainer;
                }
            }
            return response()->json($result);
        }
    }

    //sessions
    public function session_add($id)
    {
        $trainers = '';
        $classes = DB::table('session_classes')->get();
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get();
        }
        return view('Epm.Sessions.add-session',compact('trainers','classes'));
    }

    public function session_classes(){
        $result = [];
            $classes = DB::table('session_classes')->orderBy('created_at','desc')->get();
            if (!empty($classes)){
                foreach ($classes as $class){
                    $result[]=$class;
                }
            }
            return response()->json($result);

    }

    public function sessions_list()
    {
//        $sessions = TrainingSession::orderBy('created_at','desc')->get();
        $sessions = DB::table('training_sessions')->orderBy('created_at','desc')->get();
        return view('Epm.Sessions.sessions',compact('sessions'));
    }

    public function view_session($id,$session_id)
    {
//        $data = new ExcelReader();
        $trainingSession = TrainingSession::find($session_id);
        return view('Epm.Sessions.view-session',compact('trainingSession'));
    }

    public function session_save(Request $request,$id)
    {
        $messages = [
            'name.required'=>'Hey Session Name Please',
            'mode.required'=>'Please Select The Session Mode',
        ];
        $this->validate($request,[
            'name'=>'required',
            'date'=>'required',
            'mode'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'category'=>'required',
            'about'=>'required',
        ],$messages);
        $session = new TrainingSession();
        $session->name = $request->name;
        $session->date = $request->date;
        $session->start_time = $request->start_time;
        $session->end_time = $request->end_time;
        $session->institution = $request->institution;
        $session->county = $request->county;
        $session->location = $request->location;
        $session->location_lat_long = $request->location_lat_long;
        $session->category = $request->category;
        $session->mode = $request->mode;
        $classes = null;
        $session->type = $request->type;
        $session->about = $request->about;
        $trainers_list = null;
        if ($request->input('trainers')){
            $trainers_list = $request->input('trainers');
        }
        if ($request->input('s_classes')){
            $classes = $request->input('s_classes');
        }
        $saved = $session->save();
        if ($saved){
            $saved_session = TrainingSession::find($session->id);
            if ($trainers_list!=null){
                $saved_session->trainers()->attach($trainers_list);
            }
            if ($classes!=null){
                $saved_session->classes()->attach($classes);
            }
        }
        return redirect('/adm/'.$id.'/list/sessions')->with('success','New Session successfully created');

    }
    // create an array of trainers not added to a particular session
    public function new_session_trainers($id){
        $added_trainers_ids = json_decode(DB::table('trainer_training_session')->where('training_session_id',$id)->pluck('trainer_id'));
        $role = DB::table('roles')->where('name','Trainer')->first();
        $trainers_ids = '';
        if ($role){
            $trainers_ids = json_decode(DB::table('users')->where('role_id',$role->id)->pluck('id'));
        }
        $new_trainers_ids = [];
        foreach ($trainers_ids as $trainer_id){
            if (!in_array($trainer_id,$added_trainers_ids)){
                $trainers = DB::table('users')->where('role_id',$role->id)->where('id',$trainer_id)->get();
                foreach ($trainers as $trainer){
                    $new_trainers_ids[] = $trainer;
                }
            }
        }
        return response()->json($new_trainers_ids);
    }

    public function session_add_trainers($id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $session = DB::table('training_sessions')->where('id',$id)->first();
            return view('Epm.Sessions.add-trainers',compact('session'));
        }
    }

    public function session_save_trainers(Request $request,$id,$session_id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $session_trainers = $request->new_session_trainers_ids;
            TrainingSession::find($session_id)->trainers()->attach($session_trainers);
            return redirect('/adm/'.$admin->id.'/view/session/'.$session_id)->with('success','Trainer Successfully added to Session');
        }
    }

    public function session_add_trainees($id,$session_id){
        $session = TrainingSession::find($session_id);
       return view('Epm.Trainees.add-trainees',compact('session'));
    }

    public function session_upload_trainees($id,$session_id){
        $session = TrainingSession::find($session_id);
        return view('Epm.Trainees.upload-trainees',compact('session'));
    }

    public function download_trainees_excel_template()
    {
        return Excel::download(new TraineesTemplateExport(), 'trainees.xlsx');
    }

    public function upload_trainees(Request $request,$id,$session_id){

        $messages = [
            'trainees.required'=>'Please Select trainees Excel File to Upload',
        ];
        $this->validate($request,[
            'trainees'=>'required',
        ],$messages);
        $trainees_excel = Excel::toArray(new TraineesImport(), $request->file('trainees'));
        $trainees_raw = [];
        foreach ($trainees_excel as $trainee_excel){
            $trainees_raw[] = $trainee_excel;
        }
        $trainees = array_slice($trainees_raw[0],1);
        $saved = '';
        $session = null;
        foreach ($trainees as $trainee){
            $session = DB::table('training_sessions')->where('id',$session_id)->first();
            $session_trainee = new Trainee();
            $session_trainee->name =$trainee[0];
            $session_trainee->gender=$trainee[1];
            $session_trainee->email = $trainee[2];
            $session_trainee->phone_number = $trainee[3];
            $session_trainee->id_number = $trainee[4];
            $session_trainee->age = $trainee[5];
            $session_trainee->level_of_computer_literacy = $trainee[6];
            $session_trainee->level_of_education = $trainee[7];
            $session_trainee->field_of_study = $trainee[8];
            $session_trainee->interests = $trainee[9];
            $session_trainee->session_id = $session->id;
            $session_trainee->category = $session->category;
            if ($session->mode == 'Physical'){
                $session_trainee->county = $session->county;
                $session_trainee->location = $session->location;
                $session_trainee->location_lat_long = $session->location_lat_long;
            }
            $saved_trainee = $session_trainee->save();
            if ($saved_trainee){
               $session->trainees()->attach($session_trainee->id);
            }
        }
       return redirect('/adm/'.$id.'/view/session/'.$session_id)->with('success','Trainees Successfully uploaded');
    }
    public function session_save_trainees(Request $request,$id,$session_id){
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'age'=>'required',
            'id_number'=>'required',
        ]);
        $session  = TrainingSession::find($session_id);
        $trainee = New Trainee();
        $trainee->name = $request->name;
        $trainee->gender = $request->gender;
        $trainee->email = $request->email;
        $trainee->phone_number = $request->phone_number;
        $trainee->id_number = $request->id_number;
        $trainee->age = $request->age;
        $trainee->level_of_computer_literacy = $request->level_of_computer_literacy;
        $trainee->level_of_education = $request->level_of_education;
        $trainee->field_of_study = $request->field_of_study;
        $trainee->interests = $request->interests;
        $trainee->category = $session->category;
        if ($session->mode == 'Physical'){
            $trainee->county = $session->county;
            $trainee->location = $session->location;
            $trainee->location_lat_long = $session->location_lat_long;
        }
        $trainee->save();
        if ($trainee->save()){
            $session->trainees()->attach($trainee->id);
        }
        return redirect('/adm/'.$id.'/view/session/'.$session_id)->with('success','Trainee successfully added to session');
    }

    public function mentor_save(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users','regex:/\w+\.?\w+@\w+\.\w{2,3}(\.\w{2,3})?$/'],
            'phone' => ['required','regex:/^(\+254|0)\d{9}$/','unique:users'],
            'gender' => ['required'],
            'employee_number' => ['required','unique:users'],
            'county' => ['required'],
        ]);
        $mentor = new User();
        $mentor->role_id = '';
        $role = new Role();
        $role->name = 'Mentor';
        $role_exists = DB::table('roles')->where('name',$role->name)->first();
        if ($role_exists){
            $mentor->role_id = $role_exists->id;
        }else{
            $role->save();
            $mentor->role_id = $role->id;
        }
        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $email = $mentor->email;
        $mentor->phone = $request->phone;
        $mentor->gender = $request->gender;
        $mentor->employee_number = $request->employee_number;
        $mentor->county = $request->county;
        $mentor->location = $request->location;
        $mentor->location_lat_long = $request->location_lat_long;
        $mentor->is_admin = 1;
        $mentor->bio = $request->bio;
        if ($request->hasFile('image')){
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('Mentors/images',$fileName);
                $mentor->image = $fileName;
            }
        }
        $created = $mentor->save();
        if ($created){
            //send email invite to new added user
            $data = [
                'name'=>$mentor->name,
                'user_id'=>$mentor->id,
                'email'=>$mentor->email,
                'phone'=>$mentor->phone,
                'gender'=>$mentor->gender,
                'county'=>$mentor->county,
                'location'=>$mentor->location,
                'location_lat_long'=>$mentor->location_lat_long,
            ];
            Mail::to($email)->send(new CreatePassword($data));
            return redirect('/list/all/admins/role_id='.$mentor->role_id)->with('success','Mentor created Successfully');
        }
    }

    /**
     * Teams
     */
    public function team_cms_list(){
        $teams = DB::table('team_center_managers')->orderBy('created_at','desc')->get();
        $members = '';
        foreach ($teams as $team){
            $members = TeamCenterManager::find($team->id);
        }
        return view('Epm.Teams.cms',compact('teams','members'));
    }

    public function team_trainers_list(){
        $teams = DB::table('team_trainers')->orderBy('created_at','desc')->get();
        return view('Epm.Teams.trainers',compact('teams'));
    }

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
    public function store(Request $request)
    {
        //
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
