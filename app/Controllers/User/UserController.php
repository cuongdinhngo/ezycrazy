<?php

namespace App\Controllers\User;

use Atom\Controllers\Controller as BaseController;
use Atom\Http\Response;
use Atom\IMDB\Redis;
use Atom\Http\Request;
use Atom\Db\Database;
use Atom\Validation\Validator;
use Atom\Guard\Token;
use Atom\File\Log;
use Atom\File\Image;
use Atom\File\CSV;
use Atom\Guard\Auth;
use Atom\Template\Template;
use App\Models\User;
use App\Models\TimeReport;

class UserController extends BaseController
{
    private $user;
    private $timeReport;
    private $log;
    private $template;

    /**
     * User Controller construct
     *
     * @param User       $user       User
     * @param TimeReport $timeReport TimeReport
     */
    public function __construct(User $user, TimeReport $timeReport)
    {
        parent::__construct();
        $this->user = $user;
        $this->timeReport = $timeReport;
        $this->log = new Log();
        $this->template = new Template();
    }

    /**
     * Update
     *
     * @return json
     */
    public function updateTest()
    {
        $request = $this->request->all();
        Log::info(__METHOD__);
        Log::info($request);
        return Response::toJson($request);
    }

    /**
     * Created User Form
     *
     * @return void
     */
    public function createForm()
    {
        return view('admin', 'admin.users.create');
    }

    /**
     * Delete User
     *
     * @return void
     */
    public function delete()
    {
        $request = $this->request->all();
        $database = new Database();
        $database->enableQueryLog();
        $database->table('users')->where(['id', $request['id']])->delete();
        $this->log->info($database->getQueryLog());
        Response::redirect('/users');
    }

    /**
     * List all users
     *
     * @return [type] [description]
     */
    public function list()
    {
        // $database = new Database();
        // $database->enableQueryLog();
        // $users = $database->table('users')->select(['id', 'fullname', 'email', 'thumb'])->where(['gender', '=', 'male'])->orWhere(['gender', '=', 'female'])->get();
        // Log::info($database->getQueryLog());

        $params = [
            'gender' => 'female',
            'fullname' => 'ngo',
        ];
        $this->user->enableQueryLog();
        $users = $this->user->select(['id', 'fullname', 'email', 'thumb'])->filter($params)->get();
        Log::info($this->user->getQueryLog());

        $users = array_map(function ($user) {
            $user['thumb'] = assets('/images/users/thumb/'.$user["thumb"]);
            return $user;
        }, $users);
        if (isApi()) {
            return Response::toJson($users);
        }
        return view('admin', 'admin.users.list', compact('users'));
    }

    /**
     * Create new user
     *
     * @return [type] [description]
     */
    public function create()
    {
        //Get request
        $request = $this->request->all();

        //Check validation
        $rules = [
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'gender' => 'required|in_array:male,female',
        ];
        Validator::execute($request, $rules);
        if ($errors = Validator::errors()) {
            $old = Validator::getInput();
            return view('admin', 'admin.users.create', compact('errors', 'old'));
        }

        $request = $this->transformRequest($request);

        //encryt password
        $request['password'] = Token::generate([$request['password']], env('SECRET_KEY'));
        //insert user
        $this->user->enableQueryLog();
        $newUser = $this->user->insert($request);
        Log::info($this->user->getQueryLog());

        //insert successfully
        if ($newUser) {
            Response::redirect('/users');
        }
    }

    /**
     * Export users to CSV
     *
     * @return [type] [description]
     */
    public function exportUsers()
    {
        $this->user->enableQueryLog();
        $data = $this->user->select(['id', 'fullname', 'email', 'gender'])->get();
        Log::debug($this->user->getQueryLog());
        CSV::setHeader(['ID', 'Fullname', 'Email', 'Gender']);
        CSV::save('export_users', $data);
        return back();
    }

    /**
     * Show Imported Form
     *
     * @return [type] [description]
     */
    public function importForm()
    {
        return view('admin', 'admin.users.import');
    }

    /**
     * Import users from CSV file
     *
     * @return [type] [description]
     */
    public function importUsers()
    {
        //Get request
        $request = $this->request->all();
        //Read CSV file
        $standardHeader = config('csv.users');
        $data = CSV::toArray($request['file'], $standardHeader);

        $this->user->enableQueryLog();
        foreach (array_chunk($data, 3) as $values) {
            $this->user->insertMany($values);
        }
        Log::debug($this->user->getQueryLog());

        return Response::redirect('/users');
    }

    /**
     * Show Updated User Form
     *
     * @return [type] [description]
     */
    public function updateForm()
    {
        //Get request
        $request = $this->request->all();
        $database = new Database();
        $database->enableQueryLog();
        $user = $database->table('users')->select()->where(['id', $request['id']])->first();
        Log::info($database->getQueryLog());
        $template = [
            "header" => "admin.header",
            "content" => 'admin.users.update',
            "footer" => "admin.footer",
        ];
        $html = $this->template->setTemplate($template)->setData($user[0])->render();
        echo $html;
        exit();
    }

    /**
     * Update user
     *
     * @return [type] [description]
     */
    public function update()
    {
        //Get request
        $request = $this->request->all();

        //Check validation
        $rules = [
            'fullname' => 'required',
            'email' => 'required|email',
            'gender' => 'required|in_array:male,female',
        ];
        Validator::execute($request, $rules);
        if (Validator::errors()) {
            return back();
        }

        $request = $this->transformRequest($request);

        //update user
        $this->user->enableQueryLog();
        $this->user->where(['id', $request['id']])->update($request);
        Log::info($this->user->getQueryLog());
        Response::redirect('/users');
    }

    /**
     * Transform Request
     *
     * @param array $request [description]
     *
     * @return array
     */
    public function transformRequest(array $request)
    {
        if (false === empty($request['photo']['tmp_name'])) {
            $photo = $request['photo'];
            $path = '/public/assets/images/users';
            $size = ['50', '50'];
            $name = uniqid().'.jpg';
            $request['photo'] = Image::upload($path.'/original', $photo, $name);
            $request['thumb'] = Image::uploadResize($path.'/thumb', $photo, $size, 'thumb-'.$name);
        } else {
            unset($request['photo']);
        }
        return $request;
    }
}
