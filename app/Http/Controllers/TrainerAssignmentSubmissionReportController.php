<?php

namespace App\Http\Controllers;

use App\Models\TrainerAssignmentSubmissionReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerAssignmentSubmissionReportController extends Controller
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
            if ($admin->role->name == "Su Admin"){
//                $reports = DB::table('trainer_assignment_submission_reports')->orderBy('created_at','desc')->get();
                $reports = TrainerAssignmentSubmissionReport::orderBy('created_at','desc')->get();
                return view('Epm.Reports.trainer-assignment-submission-reports',compact('reports'));
            }elseif ($admin->role->name == "Trainer"){
//                $reports = DB::table('trainer_assignment_submission_reports')->orderBy('created_at','desc')->where('trainer_id',$admin->id)->get();
                $reports = TrainerAssignmentSubmissionReport::orderBy('created_at','desc')->where('trainer_id',$admin->id)->get();
                return view('Epm.Reports.trainer-assignment-submission-reports',compact('reports'));
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
        $trainer = User::find($id);
        if ($trainer){
            return view('Epm.Trainers.Reports.assignment-submission-report-submit',compact('trainer'));
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
//        dd($request->all());
        $trainer = User::find($id);
        if ($trainer){
            $assignment_submission_report = new TrainerAssignmentSubmissionReport();
            $assignment_submission_report->trainer_id = $trainer->id;
            $fileName = '';
            $fileUrl = '';
            if ($request->hasFile('assignment')){
                $file = $request->file('assignment');
                $fileName = $file->getClientOriginalName();
                $path = $file->move('Trainers/Assignments',$fileName);
                $fileUrl=url('/')."/".$path->getPathName();
            }
            $assignment_submission_report->assignment = $fileName;
            $assignment_submission_report->assignment_link = $fileUrl;
            $assignment_submission_report_submitted = $assignment_submission_report->save();
            if ($assignment_submission_report_submitted){
                return redirect('/adm/'.$id.'/view/trainer/assignment/submission/reports')->with('success','Assignment Submission Report Successfully Submitted');
            }
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
