<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use UsesUuid;

    protected $guarded = []; // YOLO

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function last30expenses()
    {
        return $this->hasMany(Expense::class)
//            ->get(['amount', 'gain', 'note', 'created_at'])
            ->take(2)
//            ->last()
            ;
    }
}
