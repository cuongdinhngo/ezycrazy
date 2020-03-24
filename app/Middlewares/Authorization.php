<?php

namespace App\Middlewares;

use Atom\Guard\Auth;
use Atom\File\Log;

class Authorization
{
    public function handle()
    {
        Log::info(__METHOD__);
        Auth::check();
    }
}
