<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\StudentMarks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
class MarksController extends Controller
{
    public function MarksAdd(){
        $data['years'] = StudentYear::all();
        $data['classes'] = Studentclass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.marks.marks_add',$data);
    }
}
