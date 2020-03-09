<?php

namespace App\Models;

use Atom\Models\Model as BaseModel;
use Atom\Db\Database;

class TimeReport extends BaseModel
{
    protected $table = 'time_reports';

    protected $fillable = [
        'workplace_id',
        'date',
        'hours',
        'info',
    ];
}
