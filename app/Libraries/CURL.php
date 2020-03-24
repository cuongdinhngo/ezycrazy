<?php

namespace App\Libraries;

use Atom\File\Log;
use Atom\Http\Globals;
use Atom\Libs\ClientURL\ClientURL;

class CURL extends ClientURL
{
    protected $info;

    /**
     * Call API
     *
     * @param string     $url     Url
     * @param array|null $header  Header
     * @param array|null $request Request
     *
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
        if ($result === false) {
            $result = curl_error($cURLConnection);
            Log::error("Calling API is FAILED: ". $result);
        }
        curl_close($cURLConnection);

        return json_decode($result, true);
    }

    /**
     * Call API by GET method
     *
     * @param string $url    URL
     * @param array  $header Header
     *
     * @return array
     */
    public function callApiByGet($url, $header = null)
    {
        $result = $this->url($url)
                ->header($header)
                ->returnTransfer(true)
                ->info()
                ->get()
                ->toArray();
        return $result;
    }

    /**
     * Call API by POST method
     *
     * @param string     $url     URL
     * @param array      $header  Header
     * @param array|json $request Request
     *
     * @return json
     */
    public function callApiByPost($url, $header = null, $request = null)
    {
        $result = $this->url($url)
                ->header($header)
                ->postFields($request)
                ->returnTransfer(true)
                ->get();
        return json_decode($result, true);
    }

    /**
     * Call API by customized method
     *
     * @param string $url    URL
     * @param string $method Method
     *
     * @return json
     */
    public function callApiByCustomMethod($url, $method)
    {
        $result = $this->url($url)
                ->customRequest($method)
                ->info()
                ->returnTransfer(true)
                ->exec();
        return $result;
    }
}
