<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\SessionClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CohortController extends Controller
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
            $cohorts = Cohort::orderBy("created_at","desc")->get();
            return view('Epm.Trainings.Cohorts.index',compact('cohorts'));
        }
    }

//    json array of all cohorts
    public function cohorts()
    {
        $cohorts = Cohort::orderBy("created_at","desc")->get();
        return response()->json($cohorts);
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

            return view('Epm.Trainings.Cohorts.create');
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

        $admin = User::find($id);
        if ($admin) {
            $this->validate($request, [
                'name' => ['required'],
                'category' => ['required'],
                'description' => ['required'],
            ]);
            $data = [
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
            ];
            $new_cohort = new Cohort();
            $new_cohort->name = $data['name'];
            $new_cohort->cohort_name = $data["category"]." ".$data['name'];
            $new_cohort->description = $data['description'];
            $new_cohort->category = $data['category'];
            $new_cohort->save();
            return redirect('/adm/'.$id.'/list/cohorts')->with('success','Cohort Created Successfully');
        }
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
    public function edit($id, $cohort_id)
    {
        $admin = User::find($id);
        if ($admin){
            $cohort = Cohort::find($cohort_id);
            if ($cohort){
                return view('Epm.Trainings.Cohorts.edit',compact('cohort'));
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $cohort_id)
    {
        $admin = User::find($id);
        if ($admin){
            $cohort = Cohort::find($cohort_id);
            if ($cohort){
                $data = [
                    'category'=>$request->category,
                    'name'=>$request->name,
                    'description'=>$request->description,
                ];
                $cohort->update($data);
                return redirect("/adm/".$id."/list/cohorts")->with("success","Cohort Updated Successfully");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $cohort_id)
    {
        $admin = User::find($id);
        if ($admin){
            $cohort = Cohort::find($cohort_id);
            if ($cohort){
                $cohort->delete();
                return redirect('/adm/'.$id.'/list/cohorts')->with('success','Cohort Deleted Successfully');
            }
        }
    }
}
