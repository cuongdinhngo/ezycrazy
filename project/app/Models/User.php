<?php

namespace App\Models;

use Atom\Models\Model as BaseModel;
use Atom\Db\Database;

class User extends BaseModel
{
    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'photo',
        'gender',
        'thumb',
    ];
}
