<?php

namespace App\Middlewares;

use Atom\Guard\Auth;
use Atom\File\Log;

class Authorization
{
    /**
     * Handle Authorize
     *
     * @return void
     */
    public function handle()
    {
        Log::info(__METHOD__);
        Auth::check();
    }
}
