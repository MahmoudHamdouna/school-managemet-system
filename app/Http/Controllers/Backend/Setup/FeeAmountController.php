<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    //
    public function ViewFeeAmount(){
        // $data['allData'] = FeeCategoryAmount::all(); 
        $data['allData'] = FeeCategoryAmount::select('fee_categor_id')->groupBy('fee_categor_id')->get();
        return view('backend.steup.fee_amount.view_fee_amount',$data);
    }
    public function AddFeeAmount(){
        $data ['fee_categories'] = FeeCategory::all();
        $data ['classes'] = StudentClass::all();
        return view('backend.steup.fee_amount.add_fee_amount',$data);
    }
    public function StoreFeeAmount(request $request){
        $countClass = count($request->class_id);
        if($countClass != NULL){
            for ($i=0; $i < $countClass; $i++) { 
                # code...
                $fee_amount = new FeeCategoryAmount;
                $fee_amount->fee_categor_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
           $notification = array(
            'message'=>'Fee Amount Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.amount.view')->with($notification); 
    }
    public function EditFeeAmount($fee_categor_id){
        $data['editData'] = FeeCategoryAmount::where
        ('fee_categor_id',$fee_categor_id)->orderby('class_id','asc')->get(); 
        $data ['fee_categories'] = FeeCategory::all();
        $data ['classes'] = StudentClass::all();
        return view('backend.steup.fee_amount.edit_fee_amount',$data);
    }
    public function UpdateFeeAmount(request $request,$fee_categor_id){
        if ($request->class_id == NULL) {
            $notification = array(
                'message'=>'Sorry You Dont Select any class',
                'alert-type'=>'error'
            );
            return redirect()->route('fee.amount.edit',$fee_categor_id)->with($notification); 
        }
        else{
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_categor_id',$fee_categor_id)->delete();
            for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new FeeCategoryAmount;
                $fee_amount->fee_categor_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        $notification = array(
            'message'=>'Fee Amount Updated Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('fee.amount.view')->with($notification); 
    }

    public function DetailsFeeAmount($fee_categor_id){
        $data['detailsData'] = FeeCategoryAmount::where
        ('fee_categor_id',$fee_categor_id)->orderby('class_id','asc')->get(); 

        return view('backend.steup.fee_amount.details_fee_amount',$data);
    }
}
