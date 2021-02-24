<?php

namespace App\Http\Controllers;

use App\Exports\TraineesTemplateExport;
use App\Exports\TrainersTemplateExport;
use App\Http\Middleware\CenterManager;
use App\Imports\TraineesImport;
use App\Imports\TrainersImport;
use App\Mail\CreatePassword;
use App\Mail\ForgotPassword;
use App\Mail\PmoAppraisalNotification;
use App\Mail\PmoAppraisalSuperviseNotification;
use App\Mail\WelcomeMail;
use App\Models\Center;
use App\Models\EmployeeLeaveApplication;
use App\Models\PmoAppraisalSelfScore;
use App\Models\PmoAppraisalSupervisorScore;
use App\Models\PmoPerformanceAppraisal;
use App\Models\PmoPerformanceAppraisalReport;
use App\Models\PmoPerformanceAppraisalScore;
use App\Models\PmoSupervisor;
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
use function GuzzleHttp\Promise\all;
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

    public function admins(){
        $admins_raw = User::orderBy('name','Asc')->get();
        $admins = [];
        foreach ($admins_raw as $user){
            if ($user->role->name!='Su Admin'){
                $admins[] = $user;
            }
        }
        $result = [];
        foreach ($admins as $admin){
            $result[] = $admin;
        }
        return response()->json($result);
    }

    public function index()
    {
        return view('Epm.layouts.adm-dashboard');
    }
    public function index_pmo()
    {
        return view('Epm.layouts.pmo-dashboard');
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
        $admins = User::orderBy('name','Asc')->where('role_id',$role_id)->get();
        return view('Epm.list-admins',compact('admins','role'));
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

    //log in all admins
    public function admin_login(Request $request)
    {
        $admin_info = $request->all();
        $user_exists = DB::table('users')->where('email',$admin_info['email'])->first();
        if ($user_exists){
            $result = Auth::attempt(['email'=>$admin_info['email'],'password'=>$admin_info['password']]);
            if ($result){
                $user = Auth::user();
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
        if ($admin_user) {
            $genuine_request = DB::table('password_resets')->where('email',$admin_user->email)->orderBy('created_at','desc')->first();
            if ($genuine_request){
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
                    return redirect('/')->with('error', 'Sorry Reset Password Page Expired Please Send New Forgot Password Request');
                }
            }
        }else{
            return redirect('/')->with('error','Sorry User Not Recognized');
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
//dd($request->all());
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
            $pmos = DB::table('users')->where('role_id',$role->id)->orderBy('name')->get();
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
//        dd($request->all());
        $name = $request->name;
        $pmo_id = $request->pmo;
        $question_type = $request->pmo;

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


    //sessions

    public function session_classes(){

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
    public function destroy($id,$admin_id,$role_id)
    {
        $deleted = User::find($admin_id)->delete();
        if ($deleted){
            return redirect('/list/all/admins/role_id='.$role_id)->with('success','Admin deleted Successfully');
        }
    }
}
