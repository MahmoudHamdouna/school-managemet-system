<?php

namespace App\Http\Controllers\Backend\Setup;
use App\Models\StudentYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function ViewYear(){
        $data ['allData'] = StudentYear::all();
        return view('backend.steup.year.view_year',$data);
    }
    public function AddYear(){
        return view('backend.steup.year.add_year');
    }
    public function StoreYear(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:student_classes,name',
                ]);
        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Student Year Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('student.year.view')->with($notification);   
      }

      public function StudentYearEdit($id){
        $editData = StudentYear::find($id); 
        return view('backend.steup.year.edit_year',compact('editData'));
      }

      public function StudentYearUpdate(request $request,$id){
        $validatedData =$request->validate([
                    'name' => 'required|unique:student_classes,name'
                ]);
        $data = StudentYear::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Student Year Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
    public function StudentYearDelete($id){
        $user=StudentYear::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Student Year Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
}
