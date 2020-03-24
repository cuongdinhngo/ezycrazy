<?php

namespace App\Middlewares;

use Atom\File\Log;

class FirstMiddleware
{
    public function handle()
    {
    	Log::info(__METHOD__);
    }
}
