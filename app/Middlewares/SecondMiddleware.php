<?php

namespace App\Middlewares;

use Atom\File\Log;

class SecondMiddleware
{
    public function handle()
    {
    	Log::info(__METHOD__);
    }
}
