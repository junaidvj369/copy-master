<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'dm_exams';

    protected $fillable = ['id','EXAM_NAME','EXAM_ID'];
}
