<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'dm_subject';

    protected $fillable = ['id','EXAM_ID', 'SUBJECT_ID', 'SUBJECT_NAME', 'QUESTION_COUNT'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'EXAM_ID', 'id');
    }
}
