<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Training;
use App\Models\TrainingDay;
use App\Models\User;
use Illuminate\Http\Request;

class TrainingDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function trainers($training_id){
        $training = Training::find($training_id);
        if ($training){
            $trainers = $training->trainers;
            return response()->json($trainers);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$training_id,$day_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                    $trainingDay = TrainingDay::find($day_id);
                    if ($trainingDay ){
                        return view("Epm.Trainings.overview",compact("trainingDay"));
                    }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$training_id,$day,$day_id,$session_id)
    {
        $day = TrainingDay::find($day_id);
        if ($day){
            return view("Epm.Trainings.Day.edit",compact("day"));
        }

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

    public function update_facilitators(Request $request, $id, $training_id, $day_id)
    {
//        dd($request->all());
        $admin = User::find($id);
        if($admin){
            $training = Training::find($training_id);
            if ($training){
                $day = TrainingDay::find($day_id);
                if ($day){
                    $response = [];
                    $start_time = date("H:i:s",strtotime($request->start_time));
                    $end_time = date("H:i:s",strtotime($request->end_time));
                    $facilitators = $request->trainers;
                    $exist_session = Session::where("day_id",$day->id)->where("start_time",$start_time)->where("end_time",$end_time)->first();
//                    dd($request->all());
                    if ($exist_session && $facilitators){
                        //detach existing trainers and attach new
                        $exist_session->facilitators()->detach();
                        $exist_session->facilitators()->attach($facilitators);
                        $response["status"] = 0;
                        $response["message"] = "session Facilitators Updated Success";
                        $response["data"] = $exist_session->facilitators;
//                        dd($exist_session);
                    }else{
                        $session = new Session();
                        $session->start_time =$start_time;
                        $session->end_time = $end_time;
                        $session->day_id = $day->id;
                        $session_saved = $session->save();
                        if ($session_saved){
                            if ($facilitators){
                                $session->facilitators()->attach($facilitators);
//                                dd($session->facilitators);
                                $response["status"] = 0;
                                $response["message"] = "session Facilitators Updated Success";
                                $response["data"] = $facilitators;
                            }
                        }
                    }
                    return $response;
                }
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
