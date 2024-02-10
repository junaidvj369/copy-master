<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'dm_question';

    protected $fillable = ['Q_ID', 'CLASS_ID', 'CHAPTER_NAME', 'CHAPTER_ID', 'SUBJECT_ID', 'QUESTION_ID', 'QUESTIONS', 'FIGURE_FLAG', 'OPTION_A', 'OPTION_B', 'OPTION_C', 'OPTION_D', 'OPTION_E', 'ANSWER', 'YEAR', 'EXAM_ID', 'PREVIOUS_FLAG', 'SOLUTION', 'SOLUTION_FIG', 'ERROR_FLAG', 'OPT_A_FIF_FLAG', 'OPT_B_FIF_FLAG', 'OPT_C_FIF_FLAG', 'OPT_D_FIF_FLAG', 'EXTRA_FLAG', 'HASH_NO'];

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

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'CHAPTER_ID', 'id');
    }
}
