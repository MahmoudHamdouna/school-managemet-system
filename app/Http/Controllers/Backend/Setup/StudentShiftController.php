<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function ViewShift(){
        $data['allData'] = StudentShift::all(); 
        return view('backend.steup.shift.view_shift',$data);
    }
    public function AddShift(){
        return view('backend.steup.shift.add_shift');
    }
    public function StoreShift(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:student_shifts,name',
                ]);
        $data = new StudentShift();
        $data->name = $request->name; 
        $data->save();
           $notification = array(
            'message'=>'Student shift Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('student.shift.view')->with($notification); 
    }
    public function StudentShiftEdit($id){
        $editData = StudentShift::find($id); 
        return view('backend.steup.shift.edit_shift',compact('editData'));
    }
    
    public function StudentShiftUpdate(request $request,$id){
        $validatedData = $request->validate([
    		'name' => 'required|unique:student_shifts,name,'
    		
    	]);
        $data = StudentShift::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Student shift Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
    public function StudentShiftDelete($id){
        $user=StudentShift::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Student shift Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }

}
