<?php

namespace App\Controllers;

use Atom\Controllers\Controller as BaseController;
use Atom\Http\Response;
use Atom\Http\Request;
use Atom\Db\Database;
use Atom\Validation\Validator;
use Atom\Guard\Token;
use Atom\File\Log;
use Atom\Guard\Auth;

class AdminController extends BaseController
{
    /**
     * Admin login form
     * @return [type] [description]
     */
    public function admin()
    {
        return include_view('admin.login');
    }

    /**
     * Sign in
     * @return [type] [description]
     */
    public function signIn()
    {
        $request = $this->request->all();
        $request['password'] = Token::generate([$request['password']], env('SECRET_KEY'));
        Auth::login($request);
    }
}
