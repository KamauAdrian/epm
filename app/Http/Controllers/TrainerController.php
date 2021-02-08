<?php

namespace App\Http\Controllers;

use App\Models\TrainerAssignmentSubmission;
use App\Models\TrainerAssignmentSubmissionReport;
use App\Models\TrainerDailyAttendanceForm;
use App\Models\TrainerDailyAttendanceReport;
use App\Models\TrainerDailyPhysicalTrainingReport;
use App\Models\TrainerDailyVirtualTrainingReport;
use App\Models\TrainerReport;
use App\Models\TrainerSkillCompetence;
use App\Models\TrainerTrainingTaskRole;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    public function asses_trainer($id){
        $admin = User::find($id);
        $trainers = '';
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get();
        }
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            return view('Epm.Trainers.asses-trainer',compact('trainers'));
        }
    }

    public function trainer_competence_reports($id){
        $reports = TrainerSkillCompetence::where('trainer_id',$id)->get();
        return view('Epm.Trainers.competencies-reports',compact('reports'));
    }

    public function adm_view_trainer_competence_reports($id){
        $reports = TrainerSkillCompetence::orderBy('created_at','desc')->get();
        return view('Epm.Trainers.competencies-reports',compact('reports'));
    }

    public function trainer_competence_report($id,$report_id){
        $report = TrainerSkillCompetence::find($report_id);
        return view('Epm.Trainers.competence-report',compact('report'));

    }

    public function save_trainer_assessment(Request $request, $id){
//        dd($request->delivery[0]);
        $messages = [
            'trainer_id.required'=>'Please select Trainer'
        ];
        $this->validate($request,[
            'trainer_id'=>'required',
        ],$messages);
//        dd($request->all());
        $assessment = new TrainerSkillCompetence();
        //trainer info
        $assessment->trainer_id = $request->trainer_id;
        $assessment->trainer_name = $request->trainer_name;
        $assessment->training_category = $request->training_category;

        //evaluator info
        $assessment->evaluator_id = Auth::id();
        $assessment->evaluator_name = Auth::user()->name;
        $assessment->evaluation_date = $request->date;
        $delivery_skills = [];
        foreach ($request->delivery as $key=>$delivery_skill){
            $delivery_skills[] = $delivery_skill;
        }
        $assessment->delivery_skills_rating_q1= $delivery_skills[0];
        $assessment->delivery_skills_rating_q2= $delivery_skills[1];
        $assessment->delivery_skills_rating_q3= $delivery_skills[2];
        $assessment->delivery_skills_rating_q4= $delivery_skills[3];
        $assessment->delivery_skills_rating_q5= $delivery_skills[4];
        $assessment->delivery_skills_rating_q6= $delivery_skills[5];
        $assessment->delivery_skills_rating_q7= $delivery_skills[6];
        $visual_aids_skills = [];
        foreach ($request->visual_aids as $visual_aid_skill){
            $visual_aids_skills[] = $visual_aid_skill;
        }
        $assessment->visual_aids_skills_rating_q1 = $visual_aids_skills[0];
        $assessment->visual_aids_skills_rating_q2 = $visual_aids_skills[1];
        $assessment->visual_aids_skills_rating_q3 = $visual_aids_skills[2];
        $assessment->visual_aids_skills_rating_q4 = $visual_aids_skills[3];
        $assessment->visual_aids_skills_rating_q5 = $visual_aids_skills[4];
        $assessment->visual_aids_skills_rating_q6 = $visual_aids_skills[5];
        $body_language_skills = [];
        foreach ($request->body_language as $body_language_skill){
            $body_language_skills[] = $body_language_skill;
        }
        $assessment->body_language_skills_rating_q1 = $body_language_skills[0];
        $assessment->body_language_skills_rating_q2 = $body_language_skills[1];
        $assessment->body_language_skills_rating_q3 = $body_language_skills[2];
        $audience_participation_skills = [];
        foreach ($request->audience_participation as $audience_participation_skill){
            $audience_participation_skills[] = $audience_participation_skill;
        }
        $assessment->audience_participation_skills_rating_q1 = $audience_participation_skills[0];
        $assessment->audience_participation_skills_rating_q2 = $audience_participation_skills[1];
        $assessment->audience_participation_skills_rating_q3 = $audience_participation_skills[2];
        $assessment->audience_participation_skills_rating_q4 = $audience_participation_skills[3];
        $assessment->audience_participation_skills_rating_q5 = $audience_participation_skills[4];
        $technical_competence_skills = [];
        foreach ($request->technical_competence as $technical_competence_skill){
            $technical_competence_skills[] = $technical_competence_skill;
        }
        $assessment->technical_competence_skills_rating_q1 = $technical_competence_skills[0];
        $assessment->technical_competence_skills_rating_q2 = $technical_competence_skills[1];
        $assessment->technical_competence_skills_rating_q3 = $technical_competence_skills[2];
        $assessment->technical_competence_skills_rating_q4 = $technical_competence_skills[3];

        $assessment->topics_trainer_lacks_knowledge_expertise = $request->topics_trainer_lacks_knowledge_expertise;
        $recommendations = [];
        foreach ($request->ways_trainer_can_connect_with_audience as $recommendation){
            $recommendations[] = $recommendation;
        }

        $assessment->ways_trainer_can_connect_with_audience_q1 = $recommendations[0];
        $assessment->ways_trainer_can_connect_with_audience_q2 = $recommendations[1];
        $assessment->ways_trainer_can_connect_with_audience_q3 = $recommendations[2];
        $assessment->ways_trainer_can_connect_with_audience_q4 = $recommendations[3];

        $assessment->save();
        return redirect('/adm/'.$id.'/view/trainer/competence/reports')->with('success','Assessment Checklist Submitted successfully');


    }

    public function daily_attendance_reports($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            $reports = DB::table('trainer_daily_attendance_reports')->where('trainer_id',$id)->get();
            return view('Epm.Trainers.Reports.daily-attendance-reports',compact('trainer','reports'));
        }
    }

    public function daily_attendance_report($id,$report_id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyAttendanceReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-attendance-report',compact('report'));
        }
    }

    public function daily_attendance_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer') {
            return view('Epm.Trainers.Reports.daily-attendance-report-submit',compact('trainer'));
        }
    }

    public function daily_attendance_report_save(Request $request,$id)
    {
        $messages = [
            'training_task_role.required'=>'Your Role/Task of the day is required'
        ];
        $this->validate($request,[
            'date'=>'required',
            'training_task_role'=>'required',
        ],$messages);
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $daily_attendance_report = new TrainerDailyAttendanceReport();
            $daily_attendance_report->name = $trainer->name;
            $daily_attendance_report->email = $trainer->email;
            $daily_attendance_report->phone = $trainer->phone;
            $daily_attendance_report->employee_number = $trainer->employee_number;
            $daily_attendance_report->trainer_id = $trainer->id;
            $daily_attendance_report->speciality = $request->speciality;
            $task_roles = $request->training_task_role;
            $daily_attendance_report->other_training_task_roles = $request->other_training_task_roles;
            $daily_attendance_report->date = $request->date;
            $daily_attendance_report->time = $request->time;
            $daily_attendance_report->comments = $request->comments;
            $attendance_submitted = $daily_attendance_report->save();
            $trainer_training_task_role = null;
            if ($attendance_submitted && $task_roles!=null){
                foreach ($task_roles as $task_role) {
                    $trainer_training_task_role = new TrainerTrainingTaskRole();
                    $trainer_training_task_role->name = $task_role;
                    $trainer_training_task_role->daily_attendance_report_id = $daily_attendance_report->id;
                    $trainer_training_task_role->save();
                }
                return redirect('/adm/' . $id . '/view/daily/attendance/reports')->with('success', 'Daily Attendance Report Submitted Successfully');
            }elseif ($attendance_submitted && $task_roles == null){
                return redirect('/adm/'.$id.'/view/daily/attendance/reports')->with('success','Daily Attendance Report Submitted Successfully');
            }
        }
    }

    public function virtual_training_reports($id)
    {
        $trainer = User::find($id);
        $reports = DB::table('trainer_daily_virtual_training_reports')->where('trainer_id',$id)->get();
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-virtual-training-reports',compact('trainer','reports'));
        }
    }

    public function virtual_training_report($id,$report_id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyVirtualTrainingReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-virtual-training-report',compact('report'));
        }
    }

    public function virtual_training_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-virtual-training-report-submit',compact('trainer'));
        }
    }

    public function virtual_training_report_save(Request $request,$id)
    {
//        dd($request->all());
        $this->validate($request,[
            'training_category'=>['required'],
        ]);
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $virtual_training_report = new TrainerDailyVirtualTrainingReport();
            $virtual_training_report->name = $trainer->name;
            $virtual_training_report->email = $trainer->email;
            $virtual_training_report->phone = $trainer->phone;
            $virtual_training_report->employee_number = $trainer->employee_number;
            $virtual_training_report->trainer_id = $trainer->id;
            $virtual_training_report->date = $request->date;
            $virtual_training_report->training_category = $request->training_category;
            $virtual_training_report->total_trainees_morning_session = $request->total_trainees_morning_session;
            $virtual_training_report->total_trainees_afternoon_session = $request->total_trainees_afternoon_session;
            $virtual_training_report->total_trainees_all_sessions = $request->total_trainees_all_sessions;
            $virtual_training_report->total_trainees_female = $request->total_trainees_female;
            $virtual_training_report->total_trainees_male = $request->total_trainees_male;
            $virtual_training_report->training_facilitation_techniques = $request->training_facilitation_techniques;
            $virtual_training_report->training_challenges = $request->training_challenges;
            $virtual_training_report->training_recommendation = $request->training_recommendation;
            $virtual_training_report->training_trainers_available_missing = $request->training_trainers_available_missing;
            $fileName = '';
            if ($request->hasFile('trainees_photo')){
                $image = $request->file('trainees_photo');
                if ($image->isValid()){
                    $fileName = $image->getClientOriginalName();
                    $image->move('VirtualTrainings/images',$fileName);
                }
            }
            $virtual_training_report->trainees_photo = $fileName;
            $virtual_training_report_submitted = $virtual_training_report->save();
            if ($virtual_training_report_submitted){
                return redirect('/adm/'.$id.'/view/daily/virtual/training/reports')->with('success','Daily Virtual Training Report Submitted Successfully');
            }else{
                dd('Not saved');
            }
        }
    }

    public function daily_physical_reports($id)// all daily reports
    {
        $trainer = User::find($id);
        $reports = DB::table('trainer_daily_physical_training_reports')->where('trainer_id',$id)->get();
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-physical-training-reports',compact('trainer','reports'));
        }

    }

    public function daily_physical_report($id,$report_id) //single daily report
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerDailyPhysicalTrainingReport::find($report_id);
            return view('Epm.Trainers.Reports.daily-physical-training-report',compact('report'));
        }

    }

    public function daily_physical_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.daily-physical-training-report-submit',compact('trainer'));
        }

    }


    public function daily_physical_report_save(Request $request,$id)
    {
//        dd($request->all());
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $daily_physical_training_report = new TrainerDailyPhysicalTrainingReport();
            $daily_physical_training_report->name = $trainer->name;
            $daily_physical_training_report->email = $trainer->email;
            $daily_physical_training_report->phone = $trainer->phone;
            $daily_physical_training_report->employee_number = $trainer->employee_number;
            $daily_physical_training_report->date = $request->date;
            $daily_physical_training_report->trainer_id = $trainer->id;
            $daily_physical_training_report->county = $request->county;
            $daily_physical_training_report->constituency = $request->constituency;
            $daily_physical_training_report->center = $request->center;
            $daily_physical_training_report->total_trainees = $request->total_trainees;
            $daily_physical_training_report->total_trainees_female = $request->total_trainees_female;
            $daily_physical_training_report->total_trainees_male = $request->total_trainees_male;
            $daily_physical_training_report->trainer_challenges_achievements = $request->trainer_challenges_achievements;
            $daily_physical_training_report->training_recommendation = $request->training_recommendation;
            $daily_physical_training_report->training_support = $request->training_support;
            $fileName = '';
            if ($request->hasFile('training_photo')){
                $image = $request->file('training_photo');
                $fileName= $image->getClientOriginalName();
                $image->move('PhysicalTrainings/images',$fileName);
            }
            $daily_physical_training_report->training_photo = $fileName;
            $daily_physical_training_report->next_training = $request->next_training;
            $daily_physical_training_report_submitted = $daily_physical_training_report->save();
            if ($daily_physical_training_report_submitted){
                return redirect('/adm/'.$id.'/view/daily/physical/training/reports')->with('success','Daily Physical Training Report Submitted Successfully');
            }
        }

    }

    public function assignment_submission_reports($id)//all assignment reports
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            $reports = DB::table('trainer_assignment_submission_reports')->where('trainer_id',$id)->get();
            return view('Epm.Trainers.Reports.assignment-submission-reports',compact('trainer','reports'));
        }

    }

    public function assignment_submission_report($id,$report_id)//single report
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager' || $admin->role->name == 'Trainer'){
            $report = TrainerAssignmentSubmissionReport::find($report_id);
            return view('Epm.Trainers.Reports.assignment-submission-report',compact('report'));
        }
    }

    public function assignment_submission_report_submit($id)
    {
        $trainer = User::find($id);
        if ($trainer->role->name == 'Trainer'){
            return view('Epm.Trainers.Reports.assignment-submission-report-submit',compact('trainer'));        }

    }

    public function assignment_submission_report_save(Request $request,$id)
    {
//        dd($request->all());
        $trainer = User::find($id);
        if ($trainer->role->name == "Trainer"){
            $assignment_submission_report = new TrainerAssignmentSubmissionReport();
            $assignment_submission_report->name = $trainer->name;
            $assignment_submission_report->email = $trainer->email;
            $assignment_submission_report->phone = $trainer->phone;
            $assignment_submission_report->employee_number = $trainer->employee_number;
            $assignment_submission_report->date = $request->date;
            $assignment_submission_report->trainer_id = $trainer->id;
            $assignment_submission_report->speciality = $request->speciality;
            $fileName = '';
            if ($request->hasFile('assignment')){
                $assigment = $request->file('assignment');
                $fileName = $assigment->getClientOriginalName();
                $assigment->move('Trainers/Assignments',$fileName);
            }
            $assignment_submission_report->assignment = $fileName;

            $assignment_submission_report_submitted = $assignment_submission_report->save();
            if ($assignment_submission_report_submitted){
                return redirect('/adm/'.$id.'/view/assignment/submission/reports')->with('success','Assignment Submission Report Successfully Submitted');
            }

        }
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
