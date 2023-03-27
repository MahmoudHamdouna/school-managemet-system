<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\StudentMarks;
use App\Models\AssignSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DefaultController extends Controller
{
    public function GetSubject(request $request){
        $class_id = $request->class_id;
        $allData = AssignSubject::with(['school_subject'])->where('class_id',$class_id)->get();
        return response()->json($allData);
    }

    public function GetStudents(request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id);
        return response()->json($allData);
    }
}
