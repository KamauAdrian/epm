<?php

namespace App\Http\Controllers;

use App\Exports\TraineesTemplateExport;
use App\Imports\TraineesImport;
use App\Models\Trainee;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //        $sessions = TrainingSession::orderBy('created_at','desc')->get();
        $sessions = DB::table('training_sessions')->orderBy('created_at','desc')->get();
        return view('Epm.Sessions.sessions',compact('sessions'));
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
        return view('Epm.Sessions.add-session',compact('trainers','classes'));
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
        $messages = [
            'name.required'=>'Hey Session Name Please',
            'mode.required'=>'Please Select The Session Mode',
        ];
        $this->validate($request,[
            'name'=>'required',
            'date'=>'required',
            'mode'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'category'=>'required',
            'about'=>'required',
        ],$messages);
        $session = new TrainingSession();
        $session->name = $request->name;
        $session->date = $request->date;
        $session->start_time = $request->start_time;
        $session->end_time = $request->end_time;
        $session->institution = $request->institution;
        $session->county = $request->county;
        $session->location = $request->location;
        $session->location_lat_long = $request->location_lat_long;
        $session->category = $request->category;
        $session->mode = $request->mode;
        $classes = null;
        $session->type = $request->type;
        $session->about = $request->about;
        $trainers_list = null;
        if ($request->input('trainers')){
            $trainers_list = $request->input('trainers');
        }
        if ($request->input('s_classes')){
            $classes = $request->input('s_classes');
        }
        $saved = $session->save();
        if ($saved){
            $saved_session = TrainingSession::find($session->id);
            if ($trainers_list!=null){
                $saved_session->trainers()->attach($trainers_list);
            }
            if ($classes!=null){
                $saved_session->classes()->attach($classes);
            }
        }
        return redirect('/adm/'.$id.'/list/sessions')->with('success','New Session successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$session_id)
    {
        //        $data = new ExcelReader();
        $trainingSession = TrainingSession::find($session_id);
        return view('Epm.Sessions.view-session',compact('trainingSession'));
    }

    public function session_approve($id,$session_id){
        $admin_user = User::find($id);
        if ($admin_user->role->name == 'Su Admin' || $admin_user->role->name == 'Project Manager'){
            $status = [
                'status'=>'Approved'
            ];
            $trainingSessionConfirm = DB::table('training_sessions')->where('id',$session_id)->update($status);
            return redirect('/adm/'.$id.'/view/session/'.$session_id)->with('success','Successfully approved session');
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

    /**
     * Create a json array of trainers for a session.
     */
    public function new_session_trainers($id){
        $added_trainers_ids = json_decode(DB::table('trainer_training_session')->where('training_session_id',$id)->pluck('trainer_id'));
        $role = DB::table('roles')->where('name','Trainer')->first();
        $trainers_ids = '';
        if ($role){
            $trainers_ids = json_decode(DB::table('users')->where('role_id',$role->id)->pluck('id'));
        }
        $new_trainers_ids = [];
        foreach ($trainers_ids as $trainer_id){
            if (!in_array($trainer_id,$added_trainers_ids)){
                $trainers = DB::table('users')->where('role_id',$role->id)->where('id',$trainer_id)->get();
                foreach ($trainers as $trainer){
                    $new_trainers_ids[] = $trainer;
                }
            }
        }
        return response()->json($new_trainers_ids);
    }

    /**
     * session create/add trainers.
     */
    public function create_trainers($id,$session_id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $session = DB::table('training_sessions')->where('id',$session_id)->first();
            return view('Epm.Sessions.add-trainers',compact('session'));
        }
    }

    /**
     * session store/save trainers.
     */
    public function store_trainers(Request $request,$id,$session_id){
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $session_trainers = $request->new_session_trainers_ids;
            TrainingSession::find($session_id)->trainers()->attach($session_trainers);
            return redirect('/adm/'.$admin->id.'/view/session/'.$session_id)->with('success','Trainer Successfully added to Session');
        }
    }

    /**
     * Form create/add trainees.
     */
    public function create_trainees($id,$session_id){
        $session = TrainingSession::find($session_id);
        return view('Epm.Trainees.add-trainees',compact('session'));
    }

    /**
     * session store/save trainees.
     */
    public function store_trainees(Request $request,$id,$session_id){
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'age'=>'required',
            'id_number'=>'required',
        ]);
        $session  = TrainingSession::find($session_id);
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
        $trainee->category = $session->category;
        if ($session->mode == 'Physical'){
            $trainee->county = $session->county;
            $trainee->location = $session->location;
            $trainee->location_lat_long = $session->location_lat_long;
        }
        $trainee->save();
        if ($trainee->save()){
            $session->trainees()->attach($trainee->id);
        }
        return redirect('/adm/'.$id.'/view/session/'.$session_id)->with('success','Trainee successfully added to session');
    }

    /**
     * session upload trainees.
     */
    public function upload_trainees($id,$session_id){
        $session = TrainingSession::find($session_id);
        return view('Epm.Trainees.upload-trainees',compact('session'));
    }

    /**
     * session save/store uploaded trainees.
     */
    public function store_uploaded_trainees(Request $request,$id,$session_id){

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
        $session = TrainingSession::find($session_id);
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
            $session_trainee->session_id = $session->id;
            $session_trainee->category = $session->category;
            if ($session->mode == 'Physical'){
                $session_trainee->county = $session->county;
                $session_trainee->location = $session->location;
                $session_trainee->location_lat_long = $session->location_lat_long;
            }
            $saved_trainee = $session_trainee->save();
            if ($saved_trainee){
                $session->trainees()->attach($session_trainee->id);
            }
        }
        return redirect('/adm/'.$id.'/view/session/'.$session_id)->with('success','Trainees Successfully uploaded');
    }

    /**
     * session download trainees excel template.
     */
    public function download_excel_template()
    {
        return Excel::download(new TraineesTemplateExport(), 'trainees.xlsx');
    }
}
