<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $centers = Center::orderBy('created_at','desc')->get();

        return view('Epm.Centers.centers',compact('centers'));

    }

    public function centers()
    {
        $centers = Center::orderBy("created_at","desc")->get();
        return response()->json($centers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('Epm.Centers.add-center');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'county' => ['required'],
                'location' => ['required'],
            ]
        );
        $center = new Center();
        $center->name = request('name');
        $center->county = request('county');
        $center->location = request('location');
        $center->location_lat_long = request('location_lat_long');
        $center_saved = $center->save();
        if ($center_saved) {
            $request->session()->flash('message', 'Center Added Successfully');
            return redirect("/adm/".$id."/view/center/".$center->id)->with("success", $request->session()->get('message'));
        }else{
            $request->session()->flash('message', 'An error occurred when trying to create Center please try again later');
            return redirect("/adm/".$id."/list/centers")->with("error", $request->session()->get('message'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$center_id)
    {
        $center = Center::find($center_id);
        if ($center){
          return view('Epm.Centers.view-center',compact('center'));
        }
//        $center = DB::table('centers')->where('id',$center_id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$center_id)
    {
        $center = DB::table('centers')->where('id',$center_id)->first();
        return view('Epm.Centers.edit-center',compact('center'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $center_id)
    {
        $data = [];
        if ($request->hasFile('image')){
            $fileName = '';
            $image = $request->file('image');
            if ($image->isValid()){
                $fileName = $image->getClientOriginalName();
                $image->move('Centers/images',$fileName);
            }
            $data = [
                'name'=>$request->name,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'image'=>$fileName,
                'description'=>$request->description,
            ];
        }else{
            $data = [
                'name'=>$request->name,
                'county'=>$request->county,
                'location'=>$request->location,
                'location_lat_long'=>$request->location_lat_long,
                'description'=>$request->description,
            ];
        }
        $updated = DB::table('centers')->where('id',$center_id)->update($data);
        return redirect('/adm/'.$id.'/view/center/'.$center_id)->with('success','Center Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $center_id)
    {
        $data = [
            'center_id'=>null,
        ];
        $cms_in_center = DB::table('users')->where('center_id',$center_id)->update($data);

        DB::table('centers')->where('id',$center_id)->delete();

        return redirect('/adm/'.$id.'/list/centers')->with('success','Center Deleted Successfully');
    }
}
