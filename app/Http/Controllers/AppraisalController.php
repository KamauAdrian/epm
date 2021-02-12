<?php

namespace App\Http\Controllers;

use App\Mail\PmoAppraisalNotification;
use App\Mail\PmoAppraisalSuperviseNotification;
use App\Mail\SupervisorAppraisalNotification;
use App\Mail\SupervisorAppraisalSuperviseNotification;
use App\Models\Appraisal;
use App\Models\AppraisalPmoReport;
use App\Models\AppraisalReportPmo;
use App\Models\AppraisalReportSupervisor;
use App\Models\AppraisalSupervisor;
use App\Models\AppraisalSupervisorReport;
use App\Models\PmoAppraisalSelfScore;
use App\Models\PmoAppraisalSupervisorScore;
use App\Models\PmoPerformanceAppraisal;
use App\Models\PmoPerformanceAppraisalReport;
use App\Models\PmoSupervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class AppraisalController extends Controller
{
    /**
     * Display a listing of the appraisals.
     */
    public function index($id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin'){
            $appraisals = Appraisal::where('status',0)->get();
//            dd($appraisals);
            return view('Epm.Appraisals.index',compact('appraisals'));
        }elseif ($admin->role->name == 'Project Manager'){
            $appraisals = Appraisal::where('pmo_id',$admin->id)->where('status',0)->get();
            return view('Epm.Appraisals.index',compact('appraisals'));
        }
    }

    public function archive($id,$appraisal_id){
        $admin = User::find($id);
        $data = ['status'=>1,];
        $appraisal = Appraisal::find($appraisal_id)->update($data);
        if ($appraisal){
            return redirect('adm/'.$id.'/view/performance/appraisals')->with('success','Appraisal Archived Successfully');
        }
    }

    public function index_archived($id){
        $appraisals = Appraisal::where('status',1)->get();
        return view('Epm.Appraisals.archived',compact('appraisals'));
    }

    /**
     * Display a listing of the appraisals to supervise.
     */
    public function supervisions($id){
        $appraisals_to_supervise= AppraisalSupervisor::where('supervisor_id',$id)->get();
//        dd($appraisals_to_supervise);
        return view('Epm.PMs.list-performance-appraisals-to-supervise',compact('appraisals_to_supervise'));
    }

    public function supervise($id,$appraisal_id,$pmo_id){
        $appraisal = Appraisal::find($appraisal_id);
        return view('Epm.Appraisals.supervisor-submit',compact('appraisal'));
    }

    public function supervision_save(Request $request,$id,$appraisal_id){

        $appraisal = Appraisal::find($appraisal_id);
        $data = [
            'supervisor_overall_comment'=>$request->supervisor_overall_comment,
            'supervisor_sign_date'=>$request->supervisor_sign_date,
            'supervisor_signature'=>$request->supervisor_signature,
            'improvement_areas'=>$request->improvement_areas,
            'supervisor_status'=>1,
        ];
        $supervisor = AppraisalSupervisor::where('supervisor_id',$id)->where('appraisal_id',$appraisal->id)->first();
        $update_supervisor = AppraisalSupervisor::find($supervisor->id)->update($data);

        $supervisor_scores = [];
        foreach ($request->supervisor_score as $score_super){
            $supervisor_scores[] = $score_super;
        }
        $supervisor_comments = [];
        foreach ($request->supervisor_comment as $comment_super){
            $supervisor_comments[] = $comment_super;
        }

        if ($update_supervisor) {
            $data = [
                'supervisor_status' => 1,
            ];
            AppraisalSupervisor::where('appraisal_id',$appraisal->id)->update($data);
            $scores = [];
            foreach ($supervisor_scores as $supervisor_score) {
                $scores[] = ['supervisor_score' => $supervisor_score, 'appraisal_id' => $appraisal->id];
            }
            foreach ($supervisor_comments as $key => $supervisor_comment) {
                $scores[$key] += ['supervisor_comment' => $supervisor_comment];
            }
            foreach ($scores as $key => $score) {
                $supervisor_report = new AppraisalSupervisorReport();
                $supervisor_report->supervisor_score = $score['supervisor_score'];
                $supervisor_report->supervisor_comment = $score['supervisor_comment'];
                $supervisor_report->appraisal_id = $score['appraisal_id'];
                $supervisor_report->supervisor_id = $id;
                $supervisor_report->save();
            }
        }
        return redirect('adm/'.$id.'/list/pending/pmo/performance/supervision/appraisals')->with('success','Performance AppraisalController Updated Successfully');
    }

    /**
     * Show the form for creating a new appraisal .
     */
    public function create($id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin'){
            return view('Epm.Appraisals.create');
        }
    }

    /**
     * Store a newly created appraisal.
     */
    public function store(Request $request,$id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin'){
            $messages = [
                'supervisor_ids.required'=>'Please Select PMO Supervisor',
            ];
            $this->validate($request,[
                'pmo'=>'required',
                'supervisor_ids'=>'required',
            ],$messages);
//            $appraisal = new PmoPerformanceAppraisalReport();
            $appraisal = new Appraisal();
            $supervisors = [];
            foreach ($request->supervisor_ids as $supervisor_id){
                $supervisors[] = ['supervisor_id'=>$supervisor_id];
            }
            foreach ($request->supervisor_names as $key=>$supervisor_name){
                $supervisors[$key] += ['name'=>$supervisor_name];
            }
            foreach ($request->supervisor_emails as $key=>$supervisor_email){
                $supervisors[$key] += ['email'=>$supervisor_email];
            }
            $appraisal->pmo = $request->pmo;
            $appraisal->pmo_email = $request->pmo_email;
            $appraisal->pmo_id = $request->pmo_id;
            $appraisal->pmo_status = 0;
            $appraisal->status = 0;
            $appraisal->question_one = $request->question_one;
            $appraisal->question_two = $request->question_two;
            $appraisal->question_three = $request->question_three;
            $appraisal->question_four = $request->question_four;
            $appraisal->question_five = $request->question_five;
//            dd($supervisors);
            $saved = $appraisal->save();
            if ($saved){
                $pmo_email = $appraisal->pmo_email;
                $pmo = [
                    'user_id'=>$appraisal->id,
                    'name'=>$appraisal->pmo,
                    'email'=>$appraisal->pmo_email,
                ];
                Mail::to($pmo_email)->send(new PmoAppraisalNotification($pmo));
                foreach ($supervisors as $supervisor){
                    $new_supervisor = new AppraisalSupervisor();
                    $new_supervisor->supervisor = $supervisor['name'];
                    $new_supervisor->supervisor_email = $supervisor['email'];
                    $new_supervisor->supervisor_id = $supervisor['supervisor_id'];
                    $new_supervisor->appraisal_id = $appraisal->id;
                    $supervisor_saved = $new_supervisor->save();
                    if ($supervisor_saved){
                        $supervisor_email = $new_supervisor->supervisor_email;
                        $pmo_supervisor = [
                            'user_id'=>$new_supervisor->id,
                            'name'=>$new_supervisor->supervisor,
                            'email'=>$new_supervisor->supervisor_email,
                        ];

                        dd($pmo_supervisor);
                        Mail::to($supervisor_email)->send(new SupervisorAppraisalNotification($pmo_supervisor));
                    }
                }
            }
            return redirect('/adm/'.$id.'/view/performance/appraisals')->with('success','PMO Performance Appraisal Report Created Successfully');
        }
    }

    /**
     * Display the specified appraisal (appraisal as template/empty/not submitted).
     */
    public function show($id,$appraisal_id)//show appraisal template
    {
        $template = Appraisal::find($appraisal_id);
        return view('Epm.Appraisals.view-template',compact('template'));
    }

    /**
     * Display the specified appraisal (submitted appraisal).
     */
    public function appraisal($id,$appraisal_id){// show appraisal report (already submitted appraisal)
        $admin = User::find($id);
        $appraisal = Appraisal::find($appraisal_id);
        return view('Epm.Appraisals.view-appraisal',compact('appraisal'));
    }

    /**
     * Show the form for submitting an appraisal.
     */
    public function submit($id,$appraisal_id){
        $admin = User::find($id);
        $appraisal = Appraisal::find($appraisal_id);
        return view('Epm.Appraisals.pmo-submit',compact('appraisal'));
    }

    /**
     * Store a newly submitted appraisal.
     */
    public function pmo_save_appraisal(Request $request,$id,$appraisal_id){
        $pmo = User::find($id);
        $appraisal  = Appraisal::find($appraisal_id);
        $appraisal_update = [
            'pmo_employee_number'=>$pmo->employee_number,
            'pmo_department'=>$pmo->department,
            'pmo_title'=>$request->title,
            'pmo_overall_comment'=>$request->self_overall_comment,
            'pmo_sign_date'=>$request->self_sign_date,
            'pmo_signature'=>$request->self_signature,
            'pmo_status'=>1,
        ];
//        dd($appraisal_update);
        $appraisal_updated = $appraisal->update($appraisal_update);
        $self_scores = [];
        foreach ($request->self_score as $score_self){
            $self_scores[] = $score_self;
        }
        $self_comments = [];
        foreach ($request->self_comment as $comment_self){
            $self_comments[] = $comment_self;
        }
        if ($appraisal_updated) {
            $scores = [];
            foreach ($self_scores as $self_score) {
                $scores[] = ['self_score' => $self_score, 'appraisal_id' => $appraisal->id];
            }
            foreach ($self_comments as $key => $self_comment) {
                $scores[$key] += ['self_comment' => $self_comment];
            }
            foreach ($scores as $key => $score) {
                $report = new AppraisalPmoReport();
                $report->self_score = $score['self_score'];
                $report->self_comment = $score['self_comment'];
                $report->appraisal_id = $score['appraisal_id'];
                $report->save();
            }
            $supervisors = AppraisalSupervisor::where('appraisal_id',$appraisal_id)->get();
            foreach ($supervisors as $supervisor){
                $data = [
                    'name'=>$supervisor->supervisor,
                    'pmo'=>$pmo->name,
                    'pmo_email'=>$pmo->email,
                ];
                Mail::to($supervisor->supervisor_email)->send(new SupervisorAppraisalSuperviseNotification($data));
            }
            return redirect('adm/'.$id.'/view/performance/appraisals')->with('success','Performance AppraisalController Submitted Successfully');
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
