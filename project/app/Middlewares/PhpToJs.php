<?php

namespace App\Middlewares;

use Atom\Libs\PhpToJs\Transformer;
use Atom\Guard\Auth;
use Atom\File\Log;

class PhpToJs
{
    public function handle()
    {
        Log::info(__METHOD__);
        Transformer::cast([
            'define' => config('define'),
            'user_info' => Auth::user(),
        ]);
    }
}
