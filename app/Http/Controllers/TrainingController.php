<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingDay;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::orderBy("created_at","desc")->get();
        return view('Epm.Trainings.index',compact('trainings'));
    }

    public function physical($id)
    {
        return view('Epm.Trainings.TimeTable.physical-time-table');
    }
    public function virtual($id)
    {
        return view('Epm.Trainings.TimeTable.Virtual.virtual-assistant');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainers = '';
        $classes = DB::table('session_classes')->get();
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get();
        }
        return view('Epm.Trainings.create',compact('trainers','classes'));
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
        $admin = User::find($id);
        if ($admin){
            $messages = [
                'training.required'=>'Please Select Training',
                'type.required'=>'Please Select Whether Public or Private',
                'cohort.required'=>'Please Select Class/Cohort',
            ];
            $this->validate($request,[
                'training'=>'required',
                'type'=>'required',
                'start_date'=>'required',
                'cohort'=>'required',
                'about'=>'required',
            ],$messages);
            $training = new Training();
            $training->training = $request->training;
            $training->venue = $request->venue;
            $training->start_date = $request->start_date;
            $end_date = "";
            $venue = "";
            if ($request->training == "Physical" || $request->training == "TOT"){
                $venue = $request->venue;
                $end_date = date("Y-m-d",strtotime("+4 days",strtotime($training->start_date)));
            }
            if ($request->training == "Virtual"){
                $end_date = date("Y-m-d",strtotime("+1 days",strtotime($training->start_date)));
            }
            $training->venue = $venue;
            if ($venue=="Centers (AYECs)"){
                $training->center_id = $request->center;
            }
            if ($venue=="Institution (University/Tvet)"){
                $training->institution_id = $request->institution;
            }
            $training->cohort_id = $request->cohort;
            $training->end_date = $end_date;
            $training->type = $request->type;
            $training->description = $request->about;
            $trainers = $request->trainers;
            $training_saved = $training->save();
            if ($training_saved){
                $start = date_create($training->start_date);
                $end = date_create($training->end_date);
                $interval = date_diff($start, $end)->format("%d%");
                $days = [];
                for ($i=0;$i<=$interval;$i++){
                    $days[] = date("Y-m-d",strtotime("+$i day", strtotime($training->start_date)));
                }
                foreach ($days as $key=>$day){
                    $training_day = new TrainingDay();
                    $training_day->date = $day;
                    $training_day->day = $key+1;
                    $training_day->training_id = $training->id;
                    $training_day->save();
                }
                foreach ($trainers as $trainer){
                    $training->trainers()->attach($trainer);
                }
                return redirect("/adm/".$id."/view/training/".$training->id)->with("success","New {$training->training} Training Created Successfully");
            }
        }
    }

    //return json array of centers where training is taking place
    public function trainers($training_id){
        $training = Training::find($training_id);
        if ($training){
            $trainers = [];
            foreach ($training->trainers as $trainer){
                $trainers[] = $trainer->id;
            }
            return response()->json($trainers);
        }
    }
    public function centers($training_id){
        $training = Training::find($training_id);
        if ($training){
            $centers = [];
            foreach ($training->centers as $center){
                $centers[] = $center->id;
            }
            return response()->json($centers);
        }
    }
    public function cohorts($training_id){
        $training = Training::find($training_id);
        if ($training){
            $cohorts = [];
            foreach ($training->cohorts as $cohort){
                $cohorts[] = $cohort->id;
            }
            return response()->json($cohorts);
        }
    }
    public function institutions($training_id){
        $training = Training::find($training_id);
        if ($training){
            $institutions = [];
            foreach ($training->institutions as $institution){
                $institutions[] = $institution->id;
            }
            return response()->json($institutions);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$training_id)
    {
        $training = Training::find($training_id);
        if ($training){

            return view('Epm.Trainings.read',compact('training'));

        }

    }

    public function approve($id,$training_id)
    {
        $admin_user = User::find($id);
        if ($admin_user){
            if ($admin_user->role->name == "Su Admin" || $admin_user->role->name == "Project Manager"){
                $status = [
                    "status"=>"Approved"
                ];
                Training::find($training_id)->update($status);
                return redirect("/adm/".$id."/view/training/".$training_id)->with("success","Successfully approved Training");
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $training_id)
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
    public function update(Request $request, $id, $training_id)
    {
        //
    }

    public function update_trainers(Request $request, $id, $training_id)
    {
//        dd($request->all());
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $trainers = $request->trainers;
                $training->trainers()->detach();
                $training->trainers()->attach($trainers);
                return redirect("/adm/".$admin->id."/view/training/".$training->id)->with("success","Trainers Updated Successfully");
            }
        }
    }

    public function update_center(Request $request, $id, $training_id)
    {
//        dd($request->all());
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $center = [
                    'center_id'=>$request->center,
                ];
                $training->update($center);
                return redirect("/adm/".$admin->id."/view/training/".$training->id)->with("success","Center Updated Successfully");
            }
        }
    }

    public function update_cohort(Request $request, $id, $training_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $cohort = [
                    'cohort_id'=>$request->cohort,
                ];
                $training->update($cohort);
                return redirect("/adm/".$admin->id."/view/training/".$training->id)->with("success","Cohort Updated Successfully");
            }
        }
    }
    public function update_institution(Request $request, $id, $training_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $institution = [
                    'institution_id'=>$request->institution,
                ];
                $training->update($institution);
                return redirect("/adm/".$admin->id."/view/training/".$training->id)->with("success","Institution Updated Successfully");
            }
        }
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
