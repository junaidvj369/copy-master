<?php

namespace App\Traits;

use App\Models\LearnerLog;

trait HasLog
{

    public function learnerLogs()
    {
        return $this->morphMany(LearnerLog::class, 'loggable');
    }
}
