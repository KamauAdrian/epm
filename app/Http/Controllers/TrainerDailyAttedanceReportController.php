<?php

namespace App\Http\Controllers;

use App\Models\TrainerDailyAttendanceReport;
use App\Models\TrainerTrainingTaskRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerDailyAttedanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            $reports = DB::table('trainer_daily_attendance_reports')->where('trainer_id',$id)->get();
            return view('Epm.Trainers.Reports.daily-attendance-reports',compact('trainer','reports'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            return view('Epm.Trainers.Reports.daily-attendance-report-submit',compact('trainer'));
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
        $messages = [
            'training_task_role.required'=>'Your Role/Task of the day is required'
        ];
        $this->validate($request,[
            'date'=>'required',
            'training_task_role'=>'required',
        ],$messages);
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $daily_attendance_report = new TrainerDailyAttendanceReport();
            $daily_attendance_report->name = $trainer->name;
            $daily_attendance_report->email = $trainer->email;
            $daily_attendance_report->phone = $trainer->phone;
            $daily_attendance_report->employee_number = $trainer->employee_number;
            $daily_attendance_report->trainer_id = $trainer->id;
            $daily_attendance_report->speciality = $request->speciality;
            $task_roles = $request->training_task_role;
            $daily_attendance_report->other_training_task_roles = $request->other_training_task_roles;
            $daily_attendance_report->date = $request->date;
            $daily_attendance_report->time = $request->time;
            $daily_attendance_report->comments = $request->comments;
            $attendance_submitted = $daily_attendance_report->save();
            $trainer_training_task_role = null;
            if ($attendance_submitted && $task_roles!=null){
                foreach ($task_roles as $task_role) {
                    $trainer_training_task_role = new TrainerTrainingTaskRole();
                    $trainer_training_task_role->name = $task_role;
                    $trainer_training_task_role->daily_attendance_report_id = $daily_attendance_report->id;
                    $trainer_training_task_role->save();
                }
                return redirect('/adm/' . $id . '/view/daily/attendance/reports')->with('success', 'Daily Attendance Report Submitted Successfully');
            }elseif ($attendance_submitted && $task_roles == null){
                return redirect('/adm/'.$id.'/view/daily/attendance/reports')->with('success','Daily Attendance Report Submitted Successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$report_id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyAttendanceReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-attendance-report',compact('report'));
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
}
