<?php

namespace App\Http\Controllers;

use App\Exports\TraineesTemplateExport;
use App\Imports\TraineesImport;
use App\Models\SessionClass;
use App\Models\Trainee;
use App\Models\TrainingDay;
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
//        $sessions = DB::table('training_sessions')->orderBy('created_at','desc')->get();
        $sessions = TrainingSession::orderBy("created_at","desc")->get();
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
        $messages = [
            'name.required'=>'Hey Session Name Please',
            'type.required'=>'Please Select The Session Mode',
        ];
        $this->validate($request,[
            'name'=>'required',
            'type'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'category'=>'required',
        ],$messages);
        $session = new TrainingSession();
        $session->name = $request->name;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;
        $session->category = $request->category;
        $session->type = $request->type;
        $session->about = $request->about;
        $session_saved = $session->save();
        if ($session_saved){
            $start = date_create($session->start_date);
            $end = date_create($session->end_date);
            $interval = date_diff($start, $end)->format('%d%');
            $days = [];
            for ($i=0;$i<=$interval;$i++){
                $days[] = date('Y-m-d',strtotime("+$i day", strtotime($session->start_date)));
            }
//            dd($session->start_date,$interval,$session->end_date,$days);
            foreach ($days as $day){
                $training_day = new TrainingDay();
                $training_day->day = $day;
                $training_day->session_id = $session->id;
                $training_day->save();
            }

            return redirect("/adm/".$id."/view/session/".$session->id)->with("success","New Session Created Successfully");
        }
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
//        $origin = date_create($trainingSession->start_date);
//        $target = date_create($trainingSession->end_date);
//        $interval = date_diff($origin, $target)->format('%d%');
//        $days = [];
//        for ($i=0;$i<=$interval;$i++){
//            $days[] = date('Y-m-d',strtotime("+$i day", strtotime($trainingSession->start_date)));
//        }
//        dd($trainingSession->start_date,$interval,$days,$trainingSession->end_date);
        return view('Epm.Sessions.view-session',compact('trainingSession'));
    }

    public function training_per_day($id,$session_id,$day_id){
        $trainingDay = TrainingDay::find($day_id);
//        $trainingSession = TrainingSession::find($session_id);
        if ($trainingDay ){
            $trainingSession = $trainingDay->session;
//            dd($trainingSession);
            return view("Epm.Sessions.session-per-day",compact("trainingSession","trainingDay"));
        }
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
        $added_trainers_ids = json_decode(DB::table('trainer_session_single_day')->where('day_id',$id)->pluck('trainer_id'));
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
    public function new_session_classes($id){
        $added_classes_id = json_decode(DB::table('training_session_classes_single_day')->where('day_id',$id)->pluck('class_id'));
        $role = DB::table('roles')->where('name','Trainer')->first();
        $classes_id = json_decode(SessionClass::orderBy("created_at","desc")->pluck("id"));
        $new_classes_id = [];
        foreach ($classes_id as $class_id){
            if (!in_array($class_id,$added_classes_id)){
                $classes = SessionClass::orderBy("created_at","desc")->where('id',$class_id)->get();
                foreach ($classes as $class){
                    $new_classes_id[] = $class;
                }
            }
        }
        return response()->json($new_classes_id);
    }

    /**
     * session create/add trainers.
     */
    public function create_trainers($id,$session_id,$day_id){
        $admin = User::find($id);
        if ($admin){
//            $session = DB::table('training_sessions')->where('id',$session_id)->first();
            $session = TrainingSession::find($session_id);
            if ($session){
                $trainingDay = TrainingDay::find($day_id);
                if ($trainingDay){
                    return view("Epm.Sessions.add-trainers",compact("session","trainingDay"));
                }
            }
        }
    }

    /**
     * session store/save trainers.
     */
    public function store_trainers(Request $request,$id,$session_id,$day_id){
        $admin = User::find($id);
        if ($admin){

        if ($admin->role->name == "Su Admin" || $admin->role->name == "Project Manager"){
            $trainingDay = TrainingDay::find($day_id);
            if ($trainingDay){
                $session_trainers = $request->new_session_trainers_ids;
//                TrainingSession::find($session_id)->trainers()->attach($session_trainers);
                $trainingDay->trainers()->attach($session_trainers);
                return redirect("/adm/".$admin->id."/view/session/".$session_id."/training/day/".$trainingDay->id)->with("success","Trainers Successfully added to Session");
            }
        }

        }
    }

    public function create_classes($id,$session_id,$day_id){
        $admin = User::find($id);
        if ($admin){
//            $session = DB::table('training_sessions')->where('id',$session_id)->first();
            $session = TrainingSession::find($session_id);
            if ($session){
                $trainingDay = TrainingDay::find($day_id);
                if ($trainingDay){
                    return view("Epm.Sessions.add-classes",compact("session","trainingDay"));
                }
            }
        }
    }

    /**
     * session store/save trainers.
     */
    public function store_classes(Request $request,$id,$session_id,$day_id){
        $admin = User::find($id);
        if ($admin){

            if ($admin->role->name == "Su Admin" || $admin->role->name == "Project Manager"){
                $trainingDay = TrainingDay::find($day_id);
                if ($trainingDay){
                    $session_trainers = $request->new_session_trainers_ids;
//                TrainingSession::find($session_id)->trainers()->attach($session_trainers);
                    $trainingDay->trainers()->attach($session_trainers);
                    return redirect("/adm/".$admin->id."/view/session/".$session_id."/training/day/".$trainingDay->id)->with("success","Trainers Successfully added to Session");
                }
            }

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
