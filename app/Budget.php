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

    public function latestExpenses()
    {
        return $this->hasMany(Expense::class)
            ->latest()
            ->take(5)
            ;
    }
}
