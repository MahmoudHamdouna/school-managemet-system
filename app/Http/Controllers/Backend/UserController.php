<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function UserView(){
        $data['allData'] = User::where('usertype','Admin')->get();
        return view('backend.user.view_user',$data);
    }

    public function UserAdd(){
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request){
        $validatedData =$request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);
        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->code = $code;
        $data->password = bcrypt($code);
        $data->save();

        $notification = array(
            'message'=>'User Inserted Successfuly',
            'alert-type'=>'success'
        );
        return redirect()->route('users.view')->with($notification);
    }

    public function UserEdit($id){
        $editData=User::find($id);
        return view('backend.user.edit_user',compact('editData'));
    }

    public function UserUpdate(Request $request,$id){
        $data = User::find($id);
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array(
            'message'=>'User Updated Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('users.view')->with($notification);
    }

    public function UserDelete($id){
        $user=User::find($id);
        $user->delete();
        $notification = array(
            'message'=>'User Deleted Successfuly',
            'alert-type'=>'info'
        );
        return redirect()->route('users.view')->with($notification);
    }
} 
