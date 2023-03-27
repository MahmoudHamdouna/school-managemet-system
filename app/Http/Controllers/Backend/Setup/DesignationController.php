<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //
    public function ViewDesignation(){
        $data['allData'] = Designation::all(); 
        return view('backend.steup.designation.view_designation',$data);
    }

    public function AddDesignation(){
        return view('backend.steup.designation.add_designation');
    }
    public function StoreDesignation(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:designations,name',
                ]);
           $data = new Designation();
           $data->name = $request->name;
           $data->save();
           $notification = array(
            'message'=>'Designation Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('designation.view')->with($notification); 
    }
    public function DesignationEdit($id){
        $editData = Designation::find($id); 
        return view('backend.steup.designation.edit_designation',compact('editData'));
    }
    public function DesignationUpdate(request $request,$id){
        $validatedData =$request->validate([
                    'name' => 'required|unique:designations,name'
                ]);
        $data = Designation::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Designation Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('designation.view')->with($notification);
    }
    public function DesignationDelete($id){
        $user=Designation::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Designation Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('designation.view')->with($notification);
    }
}
