<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignStudent extends Model
{
    use HasFactory;

    public function student(){
        return $this->BelongsTo(User::class,'student_id','id');
    }

    public function discount(){
        return $this->BelongsTo(DiscountStudent::class,'id','assign_student_id');
    }

    public function student_class(){
        return $this->BelongsTo(StudentClass::class,'class_id','id');
    }

    public function student_year(){
        return $this->BelongsTo(StudentYear::class,'year_id','id');
    }
    
    public function group(){
        return $this->belongsTo(StudentGroup::class,'group_id','id');
    }

    public function shift(){
        return $this->belongsTo(StudentShift::class,'shift_id','id');
    }
    
}
