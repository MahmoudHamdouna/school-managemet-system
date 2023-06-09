<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    //
    public function ViewFeeCat(){
        $data['allData'] = FeeCategory::all(); 
        return view('backend.steup.fee_category.view_fee_cat',$data);
    }

    public function AddFeeCat(){
        return view('backend.steup.fee_category.add_fee_cat');
    }

    public function StoreFeeCat(request $request){
        $validatedData =$request->validate([
                    'name' => 'required|unique:fee_categories,name',
                ]);
           $data = new FeeCategory();
           $data->name = $request->name;
           $data->save();
           $notification = array(
            'message'=>'Student Fee Category Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.category.view')->with($notification); 
    }

    public function StudentFeeCatEdit($id){
        $editData = FeeCategory::find($id); 
        return view('backend.steup.fee_category.edit_fee_cat',compact('editData'));
    }
    public function StudentFeeCatUpdate(request $request,$id){
        // $validatedData =$request->validate([
        //             'name' => 'required|unique:fee_categories,name'
        //         ]);
        $data = FeeCategory::find($id);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message'=>'Student Fee Category Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }
    public function StudentFeeCatDelete($id){
        $user=FeeCategory::find($id);
        $user->delete();
        $notification = array(
            'message'=>'Student Class Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }
}
