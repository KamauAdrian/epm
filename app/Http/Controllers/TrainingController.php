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
                'end_date'=>'required',
                'about'=>'required',
            ],$messages);
            $training = new Training();
            $training->training = $request->training;
            $training->start_date = $request->start_date;
            $training->end_date = $request->end_date;
            $training->type = $request->type;
            $training->description = $request->about;
            $training_saved = $training->save();
            if ($training_saved){
                $start = date_create($training->start_date);
                $end = date_create($training->end_date);
                $interval = date_diff($start, $end)->format('%d%');
                $days = [];
                for ($i=0;$i<=$interval;$i++){
                    $days[] = date('Y-m-d',strtotime("+$i day", strtotime($training->start_date)));
                }
                foreach ($days as $day){
                    $training_day = new TrainingDay();
                    $training_day->day = $day;
                    $training_day->training_id = $training->id;
                    $training_day->save();
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
            if ($training->training == "Physical"){
                return view('Epm.Trainings.Physical.index',compact('training'));
            }if ($training->training == "Virtual"){
                return view('Epm.Trainings.Virtual.index',compact('training'));
            }if ($training->training == "TOT"){
                return view('Epm.Trainings.TOT.index',compact('training'));
            }
        }

    }

    public function approve($id,$training_id)
    {
        $admin_user = User::find($id);
        if ($admin_user->role->name == "Su Admin" || $admin_user->role->name == "Project Manager"){
            $status = [
                "status"=>"Approved"
            ];
//            $trainingConfirm = DB::table('training_sessions')->where('id',$training_id)->update($status);
            $trainingConfirm = Training::find($training_id)->update($status);
            return redirect("/adm/".$id."/view/training/".$training_id)->with("success","Successfully approved Training");
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
