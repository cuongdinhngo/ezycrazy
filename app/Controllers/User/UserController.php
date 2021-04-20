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
use Atom\Http\Url;

class UserController extends BaseController
{
    private $user;
    private $log;
    private $template;

    /**
     * User Controller construct
     *
     * @param User $user User
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
        $this->log = new Log();
        $this->template = new Template();
    }

    /**
     * Demo temporary signed URL
     *
     * @return string
     */
    public function put()
    {
        return Url::temporarySignedUrl('/users/add', 3);
    }

    /**
     * Update
     *
     * @param mixed $request Request
     *
     * @return json
     */
    public function updateTest(Request $request)
    {
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
        return template('admin', 'admin.users.create');
    }

    /**
     * Delete User
     *
     * @param mixed $request Request
     *
     * @return void
     */
    public function delete(Request $request)
    {
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
        /* Query Builder
        $database = new Database();
        $database->enableQueryLog();
        $users = $database->table('users')->select(['id', 'fullname', 'email', 'thumb'])->where(['gender', '=', 'male'])->orWhere(['gender', '=', 'female'])->get();
        Log::info($database->getQueryLog());
        */

        $this->user->enableQueryLog();
        $users = $this->user->select(['id', 'fullname', 'email', 'thumb'])->get();
        Log::info($this->user->getQueryLog());

        $users = array_map(function ($user) {
            $user['thumb'] = $user['thumb'] ? assets('/images/users/thumb/'.$user["thumb"]) : $user['thumb'];
            return $user;
        }, $users);
        if (isApi()) {
            return Response::toJson($users);
        }

        return template('admin', 'admin.users.list', compact('users'));
    }

    /**
     * Create new user
     *
     * @param mixed $request Request
     *
     * @return [type] [description]
     */
    public function create(Request $request)
    {
        //Check validation
        $rules = [
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'gender' => 'required|in_array:male,female',
        ];
        $data = $request->all();
        Validator::execute($data, $rules);
        if ($errors = Validator::errors()) {
            $old = Validator::getInput();
            return template('admin', 'admin.users.create', compact('errors', 'old'));
        }

        $request = $this->transformRequest($data);

        //encryt password
        $request['password'] = Token::generate([$request['password']], env('SECRET_KEY'));
        //insert user
        $this->user->enableQueryLog();
        $newUser = $this->user->insert($data);
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
        return template('admin', 'admin.users.import');
    }

    /**
     * Import users from CSV file
     *
     * @param mixed $request Request
     *
     * @return [type] [description]
     */
    public function importUsers(Request $request)
    {
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
     * @param mixed $request Request
     *
     * @return [type] [description]
     */
    public function updateForm(Request $request)
    {
        $user = $this->user->select()->where(['id', $request['id']])->first();
        $template = [
            "header" => "admin.header",
            "content" => 'admin.users.update',
            "footer" => "admin.footer",
        ];
        $html = $this->template->setTemplate($template)->setData($user->toArray())->render();
        echo $html;
        exit();
    }

    /**
     * Update user
     *
     * @param mixed $request Request
     *
     * @return [type] [description]
     */
    public function update(Request $request)
    {
        $request = $request->all();
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
     * @param mixed $request Request
     *
     * @return array
     */
    public function transformRequest($request)
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

    /**
     * Show user's detail
     *
     * @return [type] [description]
     */
    public function show(Request $request)
    {
        $this->user->enableQueryLog();
        $user = $this->user->select(['id', 'fullname', 'email', 'thumb'])where(['id', $request->id])->get();
        Log::info($this->user->getQueryLog());
        if (isApi()) {
            return Response::toJson($user);
        }

        return template('admin', 'admin.users.show', compact('user'));
    }
}
