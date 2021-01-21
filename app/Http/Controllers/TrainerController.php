<?php

namespace App\Http\Controllers;

use App\Models\TrainerReport;
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
            return view('Epm.Trainers.Reports.attendance-form-reports',compact('trainer'));
        }
    }

    public function daily_attendance_report($id,$report_id)
    {

    }

    public function daily_attendance_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            return view('Epm.Trainers.Reports.attendance-form',compact('trainer'));
        }
    }

    public function daily_attendance_report_save(Request $request,$id)
    {
        dd($request->all());

    }

    public function virtual_training_reports($id)
    {
        $trainer = User::find($id);
        $reports = [];
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.virtual-training-reports',compact('trainer','reports'));
        }
    }

    public function virtual_training_report($id,$report_id)
    {

    }

    public function virtual_training_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.virtual-training',compact('trainer'));
        }
    }

    public function virtual_training_report_save(Request $request,$id)
    {
        dd($request->all());
    }

    public function daily_reports($id)// all daily reports
    {
        $admin = User::find($id);
        $reports = [];
        if ($admin->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-report-reports',compact('admin','reports'));
        }

    }

    public function daily_report($id,$report_id) //single daily report
    {


    }

    public function daily_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-report',compact('trainer'));
        }

    }

    public function assignment_submission_reports($id)//all assignment reports
    {
        $trainer = User::find($id);
        $reports = DB::table('reports')->where('user_id',$id)->get();
//        $reports = DB::table('trainer_reports')->where('trainer_id',$id)->get();
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.assignment-submission-reports',compact('trainer','reports'));
        }

    }

    public function assignment_submission_report($id,$report_id)//single report
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.assignment-submission',compact('trainer'));
        }
    }

    public function assignment_submission_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.assignment-submission',compact('trainer'));        }

    }

    public function assignment_submission_report_save(Request $request,$id)
    {
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
