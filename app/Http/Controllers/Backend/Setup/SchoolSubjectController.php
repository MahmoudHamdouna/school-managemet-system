<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    
    public function ViewSubject(){
        $data['allData'] = SchoolSubject::all(); 
        return view('backend.steup.school_subject.view_school_subject',$data);
    }
    public function AddSubject(){
        return view('backend.steup.school_subject.add_school_subject');
    }

    public function StoreSubject(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:school_subjects,name',
                ]);
           $data = new SchoolSubject();
           $data->name = $request->name;
           $data->save();
           $notification = array(
            'message'=>'Subject Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification); 
    }
    public function SubjectEdit($id){
        $editData = SchoolSubject::find($id); 
        return view('backend.steup.school_subject.edit_school_subject',compact('editData'));
    }
    public function SubjectUpdate(request $request,$id){
        $validatedData =$request->validate([
                    'name' => 'required|unique:school_subjects,name'
                ]);
        $data = SchoolSubject::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Subject Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }
    public function SubjectDelete($id){
        $user=SchoolSubject::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Subject Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }
}
