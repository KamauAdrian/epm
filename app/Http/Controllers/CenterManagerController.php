<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\TrainingSession;
use App\Models\User;
use \DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CenterManagerController extends Controller
{
    /**
     * Center Manager Reports
     **/
    public function reports()
    {
        return view('Epm.CMs.Reports.reports');
    }

    public function check_list()
    {
        return view('Epm.CMs.Reports.pre-registration-check-list-reports');
    }

    public function check_list_submit()
    {
//        return view('Epm.CMs.Reports.pre-registration-check-list-reports');
    }

    public function work_plan()
    {
        return view('Epm.CMs.Reports.work-plan-reports');
    }

    public function weekly_reports()
    {
        return view('Epm.CMs.Reports.weekly-reports');
    }

    public function weekly_report_submit()
    {
        return view('Epm.CMs.Reports.submit-weekly-report');
    }

    public function weekly_report_save(Request $request,$id)
    {
        $data = $request->all();
        dd($data);
        return redirect('/adm/'.$id.'/weekly/reports');
    }

    public function monthly_reports()
    {
        return view('Epm.CMs.Reports.monthly-reports');
    }

    public function index()
    {
        $cm = Auth::user();
        return view('Epm.CMs.cm-dashboard',compact('cm'));
    }


    public function centers(){
        $admin_user = Auth::user();
        $centers = Center::orderBy('created_at','desc')->get();
        return view('Epm.CMs.Centers.cm-list-centers',compact('centers','admin_user'));
    }


    public function mentor_add()
    {
        return view('Epm.CMs.cm-add-mentor');
    }

    public function sessions_list()
    {
        $admin_user = Auth::user();
        $sessions = TrainingSession::orderBy('created_at','desc')->get();
//        $sessions = DB::table('training_sessions')->get();
        return view('Epm.CMs.Sessions.cm-list-sessions',compact('sessions','admin_user'));
    }

    public function session_add()
    {
        $role = DB::table('roles')->where('name','Trainer')->first();
        $trainers = DB::table('users')->where('role_id',$role->id)->get();
        return view('Epm.CMs.Sessions.cm-add-session',compact('trainers'));
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
