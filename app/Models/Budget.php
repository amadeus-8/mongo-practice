<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Budget extends Model
{
    protected $collection = 'budgets';
}
