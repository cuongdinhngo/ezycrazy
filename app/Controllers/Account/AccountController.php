<?php

namespace App\Controllers\Account;

use Atom\Controllers\Controller as BaseController;
use App\Models\Account;
use Atom\Http\Request;

class AccountController extends BaseController
{
    protected $account;

    /**
     * Construct class
     *
     * @param Account $account Account
     */
    public function __construct(Account $account)
    {
        parent::__construct();
        $this->account = $account;
    }

    /**
     * List all accounts
     *
     * @return array
     */
    public function list()
    {
        try {
            $users = $this->account->get();
            return $users;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }        
    }

    /**
     * Create new account
     *
     * @return array
     */
    public function create()
    {
        $request = $this->request->all();
        $accountInfo = $this->account->insert($request);
        return $accountInfo;
    }

    /**
     * Update account
     *
     * @return boolean
     */
    public function update()
    {
        try {
            $request = $this->request->all();
            $this->account->where(['id', '=', 8])->update($request);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Delete account
     *
     * @return boolean
     */
    public function delete()
    {
        try {
            $request = $this->request->all();
            $this->account->where(['id', '=', $request['id']])->delete();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
