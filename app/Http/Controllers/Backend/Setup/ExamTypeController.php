<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function ViewExamType(){
        $data['allData'] = ExamType::all(); 
        return view('backend.steup.exam_type.view_exam_type',$data);
    }
    public function AddExamType(){
        return view('backend.steup.exam_type.add_exam_type');
    }

    public function StoreExamType(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:exam_types,name',
                ]);
           $data = new ExamType();
           $data->name = $request->name;
           $data->save();
           $notification = array(
            'message'=>'Exam Type Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification); 
    }
    public function ExamTypeEdit($id){
        $editData = ExamType::find($id); 
        return view('backend.steup.exam_type.edit_exam_type',compact('editData'));
    }
    public function ExamTypeUpdate(request $request,$id){
        $validatedData =$request->validate([
                    'name' => 'required|unique:exam_types,name'
                ]);
        $data = ExamType::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Exam Type Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
    public function ExamTypeDelete($id){
        $user=ExamType::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Exam Type Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
}
