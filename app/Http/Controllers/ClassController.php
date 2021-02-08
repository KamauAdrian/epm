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
        $admin = User::find($id);
        $classes = DB::table('session_classes')->orderBy('created_at','asc')->get();
//        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){}
        return view('Epm.Classes.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            return view('Epm.Classes.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager') {
            $this->validate($request, [
                'name' => ['required'],
                'category' => ['required'],
                'description' => ['required'],
            ]);

            $data = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $new_class = new SessionClass();
            $new_class->name = $data['name'];
            $new_class->description = $data['description'];
            $new_class->save();
            return redirect('/adm/'.$id.'/list/classes')->with('success','Class Created Successfully');
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
    public function edit($id,$class_id)
    {
        $admin = User::find($id);
        if ($admin->role->name == 'Su Admin' || $admin->role->name == 'Project Manager'){
            $class = SessionClass::find($class_id);
            return view('Epm.Classes.edit',compact('class'));
        }
    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$class_id)
    {
        DB::table('session_classes')->where('id',$class_id)->delete();

        return redirect('/adm/'.$id.'/list/classes')->with('success','Class Deleted Successfully');
    }

    public function classes(){//json array of classes
        $result = [];
        $classes = DB::table('session_classes')->orderBy('created_at','desc')->get();
        if (!empty($classes)){
            foreach ($classes as $class){
                $result[]=$class;
            }
        }
        return response()->json($result);
    }
}
