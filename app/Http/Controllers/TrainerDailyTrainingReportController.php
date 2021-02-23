<?php

namespace App\Http\Controllers;

use App\Models\TrainerDailyTrainingReport;
use App\Models\TrainerDailyVirtualTrainingReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerDailyTrainingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $admin = User::find($id);
//        $reports = DB::table('trainer_daily_training_reports')->where('trainer_id',$id)->get();
        if ($admin){
            if ($admin->role->name =="Su Admin"){
                $reports = TrainerDailyTrainingReport::orderBy('created_at','desc')->get();
                return view("Epm.Trainers.Reports.daily-training-reports",compact("reports"));
            }elseif ($admin->role->name =="Trainer"){
                $reports = TrainerDailyTrainingReport::orderBy("created_at","desc")->where("trainer_id",$id)->get();
                return view("Epm.Trainers.Reports.daily-training-reports",compact("reports"));
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
            return view('Epm.Trainers.Reports.daily-training-report-submit',compact('trainer'));
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
//                dd($request->all());
        $this->validate($request,[
            'training_category'=>['required'],
        ]);
        $trainer = User::find($id);
        if ($trainer){
            $daily_training_report = new TrainerDailyTrainingReport();
            $daily_training_report->name = $trainer->name;
            $daily_training_report->email = $trainer->email;
            $daily_training_report->phone = $trainer->phone;
            $daily_training_report->employee_number = $trainer->employee_number;
            $daily_training_report->trainer_id = $trainer->id;
            $daily_training_report->date = $request->date;
            $daily_training_report->training_type = $request->training_type;
            $daily_training_report->training_category = $request->training_category;
            $daily_training_report->total_trainees = $request->total_trainees;
            $daily_training_report->total_trainees_female = $request->total_trainees_female;
            $daily_training_report->total_trainees_male = $request->total_trainees_male;
            $daily_training_report->trainer_challenges_achievements = $request->trainer_challenges_achievements;
            $daily_training_report->training_recommendation = $request->training_recommendation;
            $daily_training_report->training_support = $request->training_support;
            $file = '';
            $fileName = '';
            $fileUrl = '';
            if ($request->hasFile('training_photo')){
                $file = $request->file('training_photo');
                if ($file->isValid()){
                    $fileName= $file->getClientOriginalName();
                    $path= $file->move('DailyTrainings/images',$fileName);
                    $fileUrl=url('/')."/".$path->getPathName();
                    dd($fileName);
                }else{
                    dd("not valid");
                }

            }
            $daily_training_report->training_photo = $fileName;
            $daily_training_report->training_photo_url = $fileUrl;
            $daily_training_report_submitted = $daily_training_report->save();
            if ($daily_training_report_submitted){
                return redirect("/adm/".$id."/view/daily/training/reports")->with("success","Daily Training Report Submitted Successfully");
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
            $report = TrainerDailyTrainingReport::find($report_id);
            if ($report){
                return view('Epm.Trainers.Reports.daily-training-report',compact('report'));
            }
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
