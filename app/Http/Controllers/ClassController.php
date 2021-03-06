<?php

namespace App\Http\Controllers;

use App\Models\SessionClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $class_id)
    {
        $admin=User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $data = [
                'name'=>$request->name,
                'description'=>$request->description,
            ];
            $class = SessionClass::find($class_id);
            $class->update($data);
            return redirect('/adm/'.$id.'/list/classes')->with('success','Class Updated Successfully');
        }
    }


}
