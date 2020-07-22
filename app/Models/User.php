<?php

namespace App\Models;

use Atom\Models\Model as BaseModel;
use Atom\Db\Database;
use Atom\Models\Filterable;

class User extends BaseModel
{
    use Filterable;

    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'photo',
        'gender',
        'thumb',
    ];

    protected $filterable = [
        'gender',
        'fullname' => ['LIKE' => '%{fullname}%'],
    ];
}
