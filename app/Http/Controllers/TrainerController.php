<?php

namespace App\Http\Controllers;

use App\Models\TrainerAssignmentSubmission;
use App\Models\TrainerAssignmentSubmissionReport;
use App\Models\TrainerDailyAttendanceForm;
use App\Models\TrainerDailyAttendanceReport;
use App\Models\TrainerDailyPhysicalTrainingReport;
use App\Models\TrainerDailyVirtualTrainingReport;
use App\Models\TrainerReport;
use App\Models\TrainerTrainingTaskRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function daily_attendance_reports($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            $reports = DB::table('trainer_daily_attendance_reports')->where('trainer_id',$id)->get();
            return view('Epm.Trainers.Reports.daily-attendance-reports',compact('trainer','reports'));
        }
    }

    public function daily_attendance_report($id,$report_id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyAttendanceReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-attendance-report',compact('report'));
        }
    }

    public function daily_attendance_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            return view('Epm.Trainers.Reports.daily-attendance-report-submit',compact('trainer'));
        }
    }

    public function daily_attendance_report_save(Request $request,$id)
    {

        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $daily_attendance_report = new TrainerDailyAttendanceReport();
            $daily_attendance_report->name = $request->name;
            $daily_attendance_report->email = $request->email;
            $daily_attendance_report->trainer_id = $id;
            $daily_attendance_report->speciality = $request->speciality;
            $task_roles = $request->training_task_role;
            $daily_attendance_report->time = $request->time;
            $daily_attendance_report->comments = $request->comments;
            $attendance_submitted = $daily_attendance_report->save();
            $trainer_training_task_role = null;
            if ($attendance_submitted && $task_roles!=null ){
                foreach ($task_roles as $task_role){
                    $trainer_training_task_role = new TrainerTrainingTaskRole();
                    $trainer_training_task_role->name = $task_role;
                    $trainer_training_task_role->daily_attendance_report_id = $daily_attendance_report->id;
                    $trainer_training_task_role->save();
                }
                return redirect('/adm/'.$id.'/view/daily/attendance/reports')->with('success','Daily Attendance Report Submitted Successfully');
            }elseif ($attendance_submitted && $task_roles==null ){
                return redirect('/adm/'.$id.'/view/daily/attendance/reports')->with('success','Daily Attendance Report Submitted Successfully');
            }
        }


    }

    public function virtual_training_reports($id)
    {
        $trainer = User::find($id);
        $reports = DB::table('trainer_daily_virtual_training_reports')->where('trainer_id',$id)->get();
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-virtual-training-reports',compact('trainer','reports'));
        }
    }

    public function virtual_training_report($id,$report_id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyVirtualTrainingReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-virtual-training-report',compact('report'));
        }
    }

    public function virtual_training_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-virtual-training-report-submit',compact('trainer'));
        }
    }

    public function virtual_training_report_save(Request $request,$id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $virtual_training_report = new TrainerDailyVirtualTrainingReport();
            $virtual_training_report->trainer_name = $request->name;
            $virtual_training_report->trainer_id = $id;
            $virtual_training_report->training_category = $request->training_category;
            $virtual_training_report->total_trainees_morning_session = $request->total_trainees_morning_session;
            $virtual_training_report->total_trainees_afternoon_session = $request->total_trainees_afternoon_session;
            $virtual_training_report->total_trainees_all_sessions = $request->total_trainees_all_sessions;
            $virtual_training_report->total_trainees_female = $request->total_trainees_female;
            $virtual_training_report->total_trainees_male = $request->total_trainees_male;
            $virtual_training_report->training_facilitation_techniques = $request->training_facilitation_techniques;
            $virtual_training_report->training_challenges = $request->training_challenges;
            $virtual_training_report->training_recommendation = $request->training_recommendation;
            $virtual_training_report->training_trainers_available_missing = $request->training_trainers_available_missing;
            $virtual_training_report->trainees_photo = $request->trainees_photo;
            $virtual_training_report_submitted = $virtual_training_report->save();
            if ($virtual_training_report_submitted){
                return redirect('/adm/'.$id.'/view/daily/virtual/training/reports')->with('success','Daily Virtual Training Report Submitted Successfully');
            }else{
                dd('Not saved');
            }
        }
    }

    public function daily_physical_reports($id)// all daily reports
    {
        $trainer = User::find($id);
        $reports = DB::table('trainer_daily_physical_training_reports')->where('trainer_id',$id)->get();
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-physical-training-reports',compact('trainer','reports'));
        }

    }

    public function daily_physical_report($id,$report_id) //single daily report
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyPhysicalTrainingReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-physical-training-report',compact('report'));
        }

    }

    public function daily_physical_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-physical-training-report-submit',compact('trainer'));
        }

    }


    public function daily_physical_report_save(Request $request,$id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $daily_physical_training_report = new TrainerDailyPhysicalTrainingReport();
            $daily_physical_training_report->name = $request->name;
            $daily_physical_training_report->trainer_id = $id;
            $daily_physical_training_report->county = $request->county;
            $daily_physical_training_report->constituency = $request->constituency;
            $daily_physical_training_report->center = $request->center;
            $daily_physical_training_report->total_trainees = $request->total_trainees;
            $daily_physical_training_report->total_trainees_female = $request->total_trainees_female;
            $daily_physical_training_report->total_trainees_male = $request->total_trainees_male;
            $daily_physical_training_report->trainer_challenges_achievements = $request->trainer_challenges_achievements;
            $daily_physical_training_report->training_recommendation = $request->training_recommendation;
            $daily_physical_training_report->training_support = $request->training_support;
            $daily_physical_training_report->training_photo = $request->training_photo;
            $daily_physical_training_report->next_training = $request->next_training;
            $daily_physical_training_report_submitted = $daily_physical_training_report->save();
            if ($daily_physical_training_report_submitted){
                return redirect('/adm/'.$id.'/view/daily/physical/training/reports')->with('success','Daily Physical Training Report Submitted Successfully');
            }
        }

    }

    public function assignment_submission_reports($id)//all assignment reports
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $reports = DB::table('trainer_assignment_submission_reports')->where('trainer_id',$id)->get();
            return view('Epm.Trainers.Reports.assignment-submission-reports',compact('trainer','reports'));
        }

    }

    public function assignment_submission_report($id,$report_id)//single report
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerAssignmentSubmissionReport::find($report_id);
            return view('Epm.Trainers.Reports.assignment-submission-report',compact('report'));
        }
    }

    public function assignment_submission_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.assignment-submission-report-submit',compact('trainer'));        }

    }

    public function assignment_submission_report_save(Request $request,$id)
    {
//        dd($request->all());
        $trainer = User::find($id);
        if ($trainer->role->name == "Trainer"){
            $assignment_submission_report = new TrainerAssignmentSubmissionReport();
            $assignment_submission_report->name = $request->name;
            $assignment_submission_report->trainer_id = $id;
            $assignment_submission_report->employee_number = $request->employee_number;
            $assignment_submission_report->speciality = $request->speciality;
            $assignment_submission_report->assignment = $request->assignment;
            $assignment_submission_report_submitted = $assignment_submission_report->save();
            if ($assignment_submission_report_submitted){
                return redirect('/adm/'.$id.'/view/assignment/submission/reports')->with('success','Assignment Submission Report Successfully Submitted');
            }

        }
        dd($request->all());

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
