<?php

namespace App\Http\Controllers;

use App\Exports\TraineesTemplateExport;
use App\Imports\TraineesImport;
use App\Models\Trainee;
use App\Models\Training;
use App\Models\TrainingDay;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $auth_admin = User::find($id);
        $trainees = Trainee::orderBy('id','desc')->get();
        return view('Epm.Trainees.trainees',compact('trainees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$training_id, $day_id)
    {
        $training = Training::find($training_id);
        if ($training){
            $day = TrainingDay::find($day_id);
            if ($day){
                return view('Epm.Trainees.create',compact('training','day'));
            }

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id,$training_id, $day_id)
    {
        dd($request->all());
        //Note
        //1) attach trainee to training (physical virtual tot)
        //1) attach same trainee to training day (day one...)
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'age'=>'required',
            'id_number'=>'required',
        ]);
        $admin = User::find($id);
        if ($admin){
            $training  = Training::find($training_id);
            $trainee = New Trainee();
            $trainee->name = $request->name;
            $trainee->gender = $request->gender;
            $trainee->email = $request->email;
            $trainee->phone_number = $request->phone_number;
            $trainee->id_number = $request->id_number;
            $trainee->age = $request->age;
            $trainee->level_of_computer_literacy = $request->level_of_computer_literacy;
            $trainee->level_of_education = $request->level_of_education;
            $trainee->field_of_study = $request->field_of_study;
            $trainee->interests = $request->interests;
            $trainee->save();
            if ($trainee->save()){
                $training->trainees()->attach($trainee->id);
            }
            return redirect('/adm/'.$id.'/view/session/'.$training->id)->with('success','Trainee successfully added to session');
        }
    }

    /**
     * session download trainees excel template.
     */
    public function excel_template()
    {
        return Excel::download(new TraineesTemplateExport(), 'trainees.xlsx');
    }

    /**
     * session upload trainees.
     */
    public function upload($id,$training_id){
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            return view('Epm.Trainees.upload-trainees',compact('training'));
        }
    }
    /**
     * session save/store uploaded trainees.
     */
    public function upload_store(Request $request,$id,$training_id){
        dd($request->all());
        $admin = User::find($id);
        if ($admin){
            $messages = [
                'trainees.required'=>'Please Select trainees Excel File to Upload',
            ];
            $this->validate($request,[
                'trainees'=>'required',
            ],$messages);
            $trainees_excel = Excel::toArray(new TraineesImport(), $request->file('trainees'));
            $trainees_raw = [];
            foreach ($trainees_excel as $trainee_excel){
                $trainees_raw[] = $trainee_excel;
            }
            $trainees = array_slice($trainees_raw[0],1);
            $saved = '';
            $training = Training::find($training_id);
            foreach ($trainees as $trainee){
                $session_trainee = new Trainee();
                $session_trainee->name =$trainee[0];
                $session_trainee->gender=$trainee[1];
                $session_trainee->email = $trainee[2];
                $session_trainee->phone_number = $trainee[3];
                $session_trainee->id_number = $trainee[4];
                $session_trainee->age = $trainee[5];
                $session_trainee->level_of_computer_literacy = $trainee[6];
                $session_trainee->level_of_education = $trainee[7];
                $session_trainee->field_of_study = $trainee[8];
                $session_trainee->interests = $trainee[9];
                $saved_trainee = $session_trainee->save();
                if ($saved_trainee){
                    $training->trainees()->attach($session_trainee->id);
                }
            }
            return redirect("/adm/".$admin->id."/view/training/".$training->id)->with("success","Trainees Successfully uploaded");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$training_id, $day_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $trainees = $training->trainees;
                $day = TrainingDay::find($day_id);
                return view("Epm.Trainees.register",compact("trainees","day"));
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
