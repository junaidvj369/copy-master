<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'dm_chapter';

    protected $fillable = ['CHP_ID', 'EXAM_ID', 'CLASS_ID', 'SUBJECT_ID', 'CHAPTER_ID', 'CHAPTER_NAME'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'EXAM_ID', 'id');
    }

    public function getClass()
    {
        return $this->belongsTo(DmClass::class, 'CLASS_ID', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'SUBJECT_ID', 'id');
    }
}
