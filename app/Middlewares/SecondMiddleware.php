<?php

namespace App\Middlewares;

use Atom\File\Log;

class SecondMiddleware
{
    /**
     * Handle Middleware
     *
     * @return void
     */
    public function handle()
    {
        Log::info(__METHOD__);
    }
}
