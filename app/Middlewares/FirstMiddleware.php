<?php

namespace App\Middlewares;

use Atom\File\Log;

class FirstMiddleware
{
    /**
     * Hanle Middleware
     *
     * @return void
     */
    public function handle()
    {
        Log::info(__METHOD__);
    }
}
