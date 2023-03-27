<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Designation;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;

use App\Models\EmployeeAttendance;


class EmployeeAttendanceController extends Controller
{
    //
    public function attendanceView(){
        // $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        $data['allData'] = EmployeeAttendance::orderBy('id','desc')->get();
        return view('backend.employee.employee_attendance.employee_attendance_view',$data);
    }

    public function AttendanceAdd(){
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add',$data);

    }
    public function AttendanceStore(request $request){
        $countemployee = count($request->employee_id);
        for ($i=0; $i <$countemployee ; $i++) { 
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->attend_status;
            $attend->save();
            

        }
        
        $notification = array(
            'message' => 'Employee Attendance Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attendance.view')->with($notification);
    }
}
