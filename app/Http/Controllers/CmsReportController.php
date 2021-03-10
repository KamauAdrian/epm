<?php

namespace App\Http\Controllers;

use App\Models\CmsReport;
use App\Models\CmsReportQuestion;
use App\Models\CmsReportQuestionOption;
use App\Models\ReportTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $admin = User::find($id);
        if ($admin){
            $reports = "";
            if ($admin->role->name =="Su Admin" || $admin->department =="Ajira Youth Empowerment Centers (AYECs)"){
                $reports = CmsReport::orderBy("created_at","desc")->get();
                return view("Epm.CMs.Reports.index",compact("reports"));
            }
            if ($admin->role->name =="Center Manager"){
                $reports = $admin->cmReports;
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
        $admin = User::find($id);
        if ($admin){
            if ($admin->role->name == "Su Admin" || $admin->role->name == "Project Manager"){
                return view("Epm.Reports.Templates.Cms.create");
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
//        dd($request->all());
        $admin = User::find($id);
        if ($admin){
            $messages = [
                ''
            ];
            $this->validate($request,[
                ''
            ],$messages);
            $report = new CmsReport();
            $report->name = $request->name;
            $questions = $request->questions;
            $report->creator_id = $admin->id;
            $report_created = $report->save();
            if ($report_created){
                foreach ($questions as $key=>$question){
                    $x = $key+1;
                    $report_question = new CmsReportQuestion();
                    $report_question->report_id = $report->id;
                    $report_question->question = $question;
                    $report_question->question_type = $request["question_".$x."_type"];
                    if ($report_question->save()){
                        $type = $report_question->question_type;
                        if ($type == "Dropdown"){
                            $options = $request["optionsQuestion".$x];
                            foreach ($options as $option){
                                $quiz_option = new CmsReportQuestionOption();
                                $quiz_option->question_id = $report_question->id;
                                $quiz_option->option = $option;
                                $quiz_option->save();
                            }
                        }
                    }
                }
                return redirect("adm/".$admin->id."/view/cms/reports")->with("success","{$report->name} Created Successfully");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function template($id, $report_id)
    {
        $admin = User::find($id);
        if ($admin){
            $report = CmsReport::find($report_id);
            return view("Epm.CMs.Reports.template",compact("report"));
        }
    }
    public function show($id, $report_id)
    {
        $admin = User::find($id);
        if ($admin){
            $report = CmsReport::find($report_id);
            return view("Epm.CMs.Reports.template",compact("report"));
        }
    }

    public function options($question_id)
    {
        $question = CmsReportQuestion::find($question_id);
        if ($question){
            $options = $question->options;
            return response()->json($options);
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
