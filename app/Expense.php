<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use UsesUuid;

    protected $guarded = []; // YOLO

}
