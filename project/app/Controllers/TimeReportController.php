<?php

namespace App\Controllers;

use Atom\Controllers\Controller as BaseController;
use Atom\Http\Response;
use Atom\Http\Request;
use Atom\Db\Database;
use Atom\Validation\Validator;
use Atom\Guard\Token;
use Atom\File\Log;
use Atom\File\Image;
use Atom\File\CSV;
use App\Models\TimeReport;
use App\Libraries\CURL;

class TimeReportController extends BaseController
{
    protected $curl;

    public function __construct(CURL $curl)
    {
        parent::__construct();
        $this->curl = $curl;
    }

    /**
     * Created List Form
     * @return [type] [description]
     */
    public function createListForm()
    {
        try {
            return view('admin.workplace.list');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            Log::error($e->getMessage());
        }
    }

    /**
     * Created Time report Form
     * @return [type] [description]
     */
    public function createForm()
    {
        try {
            return view('admin.timereport.create');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            Log::error(__METHOD__.' => '.$e->getMessage());
        }
    }

    /**
     * Search Workplace
     * @return [type] [description]
     */
    public function search()
    {
        try {
            //Get request
            $request = $this->request->all();

            //Prepare request of getting timereports api
            if ($request["workplace"]) {
                $params["workplace"] = (int) $request["workplace"];
            }
            if ($request["fromYear"] && $request["fromMonth"] && $request["fromDay"]) {
                $params["from_date"] = date("Y-m-d", strtotime($request["fromYear"].'-'.$request["fromMonth"].'-'.$request["fromDay"]));
            }
            if ($request["toYear"] && $request["toMonth"] && $request["toDay"]) {
                $params["to_date"] = date("Y-m-d", strtotime($request["toYear"].'-'.$request["toMonth"].'-'.$request["toDay"]));
            }

            $params = empty($params) ? '': '?'.http_build_query($params);
            $url = config('define.timereport.api.list_all').$params;
            $header = config('define.timereport.header');
            $data = $this->curl->callApiByGet($url, $header);

            return view('admin.workplace.list', compact('data'));
        } catch (\Exception $e) {
            print_r($e->getMessage());
            Log::error($e->getMessage());
        }
    }

    /**
     * Create new user
     * @return [type] [description]
     */
    public function create()
    {
        //Get request
        $request = $this->request->all();
        Log::info($request);
        //Check validation
        $rules = [
            'date' => 'required',
            'workplace_id' => 'required',
            'hours' => 'required',
        ];
        Validator::execute($request, $rules);
        if ($errors = Validator::errors()) {
            Log::error($errors);
            die("Invalid Request");
        }

        $request = $this->transformRequest($request);

        unset($request['image']);
        unset($request['thumb']);

        $tmp['workplace_id'] = $request['workplace_id'];
        $tmp['date'] = $request['date'];
        $tmp['hours'] = $request['hours'];
        $tmp['info'] = $request['info'];
        Log::info($tmp);
        Log::info(json_encode($tmp));
        $url = config('define.timereport.api.create');
        $header = config('define.timereport.header_request_json');
        $data = $this->curl->callApiByPost($url, $header, json_encode($tmp));
        Log::info($data);

        // //insert time report
        // $timeReport = new TimeReport();
        // $timeReport->enableQueryLog();
        // $newTimeReport = $timeReport->insert($request);
        // Log::info($timeReport->getQueryLog());

        // //insert successfully
        // if ($newTimeReport) {
        //     die("Inserted successfully!!!");
        // }
    }

    /**
     * Transform Request
     * @param  array  $request [description]
     * @return array
     */
    public function transformRequest(array $request)
    {
        if (false === empty($request['image']['tmp_name'])) {
            $photo = $request['image'];
            $path = '/public/assets/images/timereport';
            $size = ['50', '50'];
            $name = uniqid().'.jpg';
            // $request['image'] = Image::upload($path.'/original', $photo, $name);
            // $request['thumb'] = Image::uploadResize($path.'/thumb', $photo, $size, 'thumb-'.$name);
        } else {
            unset($request['image']);
        }
        Log::info($request['date']);
        $request['date'] = date("Y-m-d", strtotime($request['date']));
        return $request;
    }
}
