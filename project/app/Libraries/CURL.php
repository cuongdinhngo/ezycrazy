<?php

namespace App\Libraries;

use Atom\File\Log;
use Atom\Http\Globals;
use Atom\Libs\ClientURL\ClientURL;

class CURL extends ClientURL
{
    /**
     * Call API
     * @param  string $url
     * @param  array|null $header
     * @param  array|null $request
     * @return array
     */
    public function callApi($url, $header = null, $request = null)
    {
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $header);
        if ($request) {
            curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $request);
        }
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($cURLConnection);

        Log::info("Call API: ". $url);
        if($result === false)
        {
            $result = curl_error($cURLConnection);
            Log::error("Calling API is FAILED: ". $error);
        }
        curl_close($cURLConnection);

        return json_decode($result, true);
    }

    public function callApiByGet($url, $header = null)
    {
        $result = $this->url($url)->header($header)->returnTransfer(true)->exec();
        return json_decode($result, true);
    }

    public function callApiByPost($url, $header = null, $request = null)
    {
        $result = $this->url($url)->header($header)->postFields($request)->returnTransfer(true)->exec();
        return json_decode($result, true);
    }

}