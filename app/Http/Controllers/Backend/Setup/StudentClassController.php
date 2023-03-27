<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function ViewStudent(){
        $data['allData'] = StudentClass::all(); 
        return view('backend.steup.student_class.view_class',$data);
    }

    public function AddStudent(){
        return view('backend.steup.student_class.add_class');
    }

    public function StoreStudent(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:student_classes,name',
                ]);
           $data = new StudentClass();
           $data->name = $request->name;
           $data->save();
           $notification = array(
            'message'=>'Student Class Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification); 
    }

    public function StudentClassEdit($id){
        $editData = StudentClass::find($id); 
        return view('backend.steup.student_class.edit_class',compact('editData'));
    }
    public function StudentClassUpdate(request $request,$id){
        $validatedData =$request->validate([
                    'name' => 'required|unique:student_classes,name'
                ]);
        $data = StudentClass::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Student Class Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
    public function StudentClassDelete($id){
        $user=StudentClass::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Student Class Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
