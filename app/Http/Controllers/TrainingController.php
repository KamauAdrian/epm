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
//            dd($request->all());
            $messages = [
                'training.required'=>'Please Select Training',
                'type.required'=>'Please Select Whether Public or Private',
            ];
            $this->validate($request,[
                'training'=>'required',
                'type'=>'required',
                'start_date'=>'required',
                'about'=>'required',
            ],$messages);
            $training = new Training();
            $training->training = $request->training;
            $training->venue = $request->venue;
            $training->start_date = $request->start_date;
            $end_time = "";
            $venue = "";
            if ($request->training == "Physical" || $request->training == "TOT"){
                $venue = $request->venue;
                $end_time = date("Y-m-d",strtotime("+4 days",strtotime($training->start_date)));
            }
            if ($request->training == "Virtual"){
                $end_time = date("Y-m-d",strtotime("+1 days",strtotime($training->start_date)));
            }
            $training->venue = $venue;
            $centers = null;
            $institutions = null;
            if ($venue=="Centers (AYECs)"){
                $centers = $request->centers;
            }
            if ($venue=="Institution (University/Tvet)"){
                $institutions = $request->institutions;
            }
//            dd($institutions,$venue);
//            dd($request->all());
            $training->end_date = $end_time;
            $training->type = $request->type;
            $training->description = $request->about;
            $trainers = $request->trainers;
            $training_saved = $training->save();
            if ($training_saved){
                if ($centers){
                    $training->centers()->attach($centers);
                }
                if ($institutions){
//                    $training->institutions()->attach($institutions);
                }
                $start = date_create($training->start_date);
                $end = date_create($training->end_date);
                $interval = date_diff($start, $end)->format("%d%");
                $days = [];
                for ($i=0;$i<=$interval;$i++){
                    $days[] = date("Y-m-d",strtotime("+$i day", strtotime($training->start_date)));
                }
//                dd($training->start_date,$interval,$end_time);
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
//                dd($training->start_date,$interval,$training->end_date,$days);
                return redirect("/adm/".$id."/view/training/".$training->id)->with("success","New Training Created Successfully");
            }
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

    public function edit_centers($id, $training_id)
    {

    }

    public function edit_classes($id, $training_id)
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

    public function update_centers(Request $request, $id, $training_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $centers = $request->centers;
            }
        }
    }

    public function update_classes(Request $request, $id, $training_id)
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
