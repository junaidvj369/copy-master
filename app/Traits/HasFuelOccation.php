<?php

namespace App\Traits;

use App\Models\LearnerFuelOccation;

trait HasFuelOccation
{
    public function fuelOccationsMorph()
    {
        return $this->morphMany(LearnerFuelOccation::class, 'action');
    }
}
