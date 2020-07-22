<?php

namespace App\Middlewares;

use Atom\Http\Url;
use Atom\Http\Response;
use Atom\File\Log;

class IdentifySignedUrl
{
	/**
	 * Identify signed Url
	 *
	 * @return void
	 */
    public function handle()
    {
        if (false === Url::identifySignature()) {
            Response::redirect('/admin');
        }
    }
}
