<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmClass extends Model
{
    use HasFactory;
    protected $table = 'dm_class';

    protected $fillable = ['id','CLASS_NAME','EXAM_ID','CLASS_ID'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'EXAM_ID', 'id');
    }
}
