<?php

namespace App\Http\Controllers;

use App\Jobs\LeaveApplicationAcceptedJob;
use App\Jobs\LeaveApplicationRejectedJob;
use App\Mail\LeaveApplicationAccepted;
use App\Mail\LeaveApplicationRejected;
use App\Models\EmployeeLeaveApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $admin = User::find($id);
        if ($admin){
            if ($admin->role->name == "Su Admin" || $admin->role->name == "Project Manager"){
                $applications = EmployeeLeaveApplication::orderBy('created_at','desc')->get();
                return view('Epm.Trainers.leave-applications',compact('applications'));
            }
            if ($admin->role->name == "Trainer"){
                $applications = EmployeeLeaveApplication::where('applicant_id',$id)->get();
                return view('Epm.Trainers.leave-applications',compact('applications'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Auth::user()->id == $id){
            return view('Epm.Forms.leave-form');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //dd($request->all());
        $messeges = [
            'leave_type.required'=>'Please select the Leave type your are taking'
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
        //proof of sick off or study Leave file upload (doctors note or exam timetable)
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
        $leave_application->status = 0;

        $leave_application->save();

        return redirect('/adm/'.$id.'/view/leave/applications')->with('success','Leave Application Success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$application_id)
    {
        if (Auth::user()->id == $id){
            $application = EmployeeLeaveApplication::find($application_id);
            return view('Epm.Trainers.leave-application',compact('application'));
        }
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

    public function accept_leave($id,$application_id)
    {
        $admin = User::find($id);
        if ($admin){
            $application = EmployeeLeaveApplication::find($application_id);
            if ($application){
                return view("Epm.accept-leave",compact("application"))->with("success","Leave Application Accepted");
            }
        }
    }

    public function accept_leave_save(Request $request,$id,$application_id)
    {
        $admin = User::find($id);
        if ($admin){
            $application = EmployeeLeaveApplication::find($application_id);
            if ($application){
                $data = [
                    'status'=>1,
                    'reason'=>$request->reason,
                ];
                $updated = $application->update($data);
                if ($updated){
                    $params = [
                        'email'=>$application->applicant_email,
                        'application'=>$application,
                    ];
                    dispatch(new LeaveApplicationAcceptedJob($params));
                    return redirect("/adm/".$id."/view/leave/application/application_id=".$application->id)->with("success","Leave Application Accepted");
                }
            }
        }
    }

    public function reject_leave($id,$application_id)
    {
        $admin = User::find($id);
        if ($admin){
            $application = EmployeeLeaveApplication::find($application_id);
            if ($application){
                return view('Epm.reject-leave',compact('application'));
            }
        }
    }

    public function reject_leave_save(Request $request,$id,$application_id)
    {
        $admin = User::find($id);
        if ($admin){
            $application = EmployeeLeaveApplication::find($application_id);
            if ($application){
                $data = [
                    'status'=>2,
                    'reason'=>$request->reason,
                ];
                $updated = $application->update($data);
                if ($updated){
                    $params = [
                        'email'=>$application->applicant_email,
                        'application'=>$application,
                    ];
                    dispatch(new LeaveApplicationRejectedJob($params));
                    return redirect("/adm/".$id."/view/leave/application/application_id=".$application->id)->with("success","Leave Application Rejected");
                }
            }
        }
    }
}
