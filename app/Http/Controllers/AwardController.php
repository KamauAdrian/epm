<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::orderBy('created_at','desc')->get();
        return view('Epm.Awards.index',compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('Epm.Awards.create');
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
            'description.required'=>'Please Provide A Short Award Description'
        ];
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ],$messages);
        $new_award = new Award();
        $new_award->name = $request->name;
        $new_award->position_one = $request->award_winner_p1;
        $new_award->position_two = $request->award_winner_p2;
        $new_award->position_three = $request->award_winner_p3;
        $new_award->description = $request->description;
        $award_saved = $new_award->save();
        if ($award_saved){
            return redirect('/adm/main/dashboard/#awards')->with("success","{$new_award->name} Created Successfully");
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
    public function edit($id,$award_id)
    {
        $award = Award::find($award_id);
        if ($award){

            return view('Epm.Awards.edit',compact('award'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$award_id)
    {
        dd($request->all());
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
