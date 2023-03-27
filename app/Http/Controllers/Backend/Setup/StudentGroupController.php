<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewGroup(){
        $data['allData'] = StudentGroup::all(); 
        return view('backend.steup.group.view_group',$data);
    }
    public function AddGroup(){
        return view('backend.steup.group.add_group');
    }
    public function StoreGroup(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:student_classes,name',
                ]);
        $data = new StudentGroup();
        $data->name = $request->name; 
        $data->save();
           $notification = array(
            'message'=>'Student Group Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('student.group.view')->with($notification); 
    }
    public function StudentGroupEdit($id){
        $editData = StudentGroup::find($id); 
        return view('backend.steup.group.edit_group',compact('editData'));
    }
    public function StudentGroupUpdate(request $request,$id){
        $validatedData = $request->validate([
    		'name' => 'required|unique:student_groups,name,'
    		
    	]);

        $data = StudentGroup::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Student Group Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
    public function StudentGroupDelete($id){
        $user=StudentGroup::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Student Group Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
}
