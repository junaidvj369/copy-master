<?php

namespace App\Traits;

trait HandleExceptions
{
    /**
     * This method is used to handle caught exceptions.
     * By default, it will log the exception.
     * Custom logic may be added here
     *
     * @author Jomit
     *
     * @param \Throwable $exception
     *
     * @return void
     */
    public function handleException($exception)
    {
        report($exception);
    }
}
