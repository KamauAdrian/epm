<?php

namespace App\Http\Controllers;

use App\Exports\CenterManagerTemplateExport;
use App\Exports\TrainersTemplateExport;
use App\Imports\CenterManagersImport;
use App\Imports\TrainersImport;
use App\Mail\CreatePassword;
use App\Models\Center;
use App\Models\Role;
use App\Models\TrainingSession;
use App\Models\User;
use \DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CenterManagerController extends Controller
{
    /**
     * Center Manager Reports
     **/
    public function reports()
    {
        return view('Epm.CMs.Reports.reports');
    }

    public function check_list()
    {
        return view('Epm.CMs.Reports.pre-registration-check-list-reports');
    }

    public function check_list_submit()
    {
//        return view('Epm.CMs.Reports.pre-registration-check-list-reports');
    }

    public function work_plan()
    {
        return view('Epm.CMs.Reports.work-plan-reports');
    }

    public function weekly_reports()
    {
        return view('Epm.CMs.Reports.weekly-reports');
    }

    public function weekly_report_submit()
    {
        return view('Epm.CMs.Reports.submit-weekly-report');
    }

    public function weekly_report_save(Request $request,$id)
    {
        $data = $request->all();
        dd($data);
        return redirect('/adm/'.$id.'/weekly/reports');
    }

    public function monthly_reports()
    {
        return view('Epm.CMs.Reports.monthly-reports');
    }

    public function index()
    {

    }

    public function cms(){
        $role = DB::table('roles')->where('name','Center Manager')->first();
        $result = [];
        if ($role){
//            $cms = DB::table('users')->where('role_id',$role->id)->get();
            $cms = User::where("role_id",$role->id)->get();
            if (!empty($cms)){
                foreach ($cms as $cm){
                    $result[]=$cm;
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
    public function store(Request $request)
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
            $data = $cm_user;
            User::SendNewUserAccountActivationEmail($email,$data);
//            Mail::to($email)->send(new CreatePassword($data));
        }
        //redirect to center managers list page with success messages
        $request->session()->flash('success_message','Center Manager created successfully');
        if ($new_cm){
            return redirect('/list/all/admins/role_id='.$cm_user->role_id)->with('success',$request->session()->get('success_message'));
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

    /**
     * Display a form to upload center manager users.
     */
    public function request_upload_cms($id){
        return view('Epm.CMs.upload-cms');
    }

    /**
     * Download an excel template for center Managers.
     */
    public function download_cms_excel_template()
    {
        return Excel::download(new CenterManagerTemplateExport(), 'cms.xlsx');
    }

    public function upload_cms(Request $request,$id){

        $messages = [
            'cms.required'=>'Please Select Center Managers Excel File to Upload',
        ];
        $this->validate($request,[
            'cms'=>'required',
        ],$messages);
//        dd($request->all());
        $cms_excel = Excel::toArray(new CenterManagersImport(), $request->file('cms'));
        $cms_raw = [];
        foreach ($cms_excel as $cm_excel){
            $cms_raw[] = $cm_excel;
        }

        $cms = array_slice($cms_raw[0],1);
        $role = new Role();
        $cm_role = null;
        $role->name = 'Center Manager';
        //check if role already created
        $exists_role = DB::table('roles')->where('name','Center Manager')->first();
        if ($exists_role){
            $cm_role = $exists_role->id;
        }else{
            $role->save();
            $cm_role= $role->id;
        }
        foreach ($cms as $cm){
            $new_cm = new User();
            $new_cm->name =$cm[0];
            $new_cm->employee_number = $cm[1];
            $new_cm->email = $cm[2];
            $new_cm->phone = $cm[3];
            $new_cm->gender=$cm[4];
            $new_cm->county=$cm[5];
            $new_cm->is_admin=1;
            $new_cm->role_id=$cm_role;
            $saved_cm = $new_cm->save();
            if ($saved_cm){
                $email = $new_cm->email;
                $data = $new_cm;
                User::SendNewUserAccountActivationEmail($email,$data);
//                Mail::to($new_cm->email)->send(new CreatePassword($data));
            }
        }
        return redirect('/list/all/admins/role_id='.$cm_role)->with('success','Center Managers uploaded Successfully');
    }
}
