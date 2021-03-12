<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\Training;
use App\Models\TrainingDay;
use App\Models\User;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $training_id, $category_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $category = JobCategory::find($category_id);
                if ($category){
                    return view("Epm.Trainings.Virtual.index",compact("training","category"));
                }
            }
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
    public function show($id,$training_id, $category_id, $day_id)
    {
        $admin = User::find($id);
        if ($admin){
            $training = Training::find($training_id);
            if ($training){
                $category = JobCategory::find($category_id);
                if ($category){
                    $trainingDay = TrainingDay::find($day_id);
                    if ($trainingDay ){
                        return view("Epm.Trainings.Virtual.read",compact("trainingDay","category"));
                    }
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
