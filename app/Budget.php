<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Budget extends Model
{
    use UsesUuid;

    const LATEST_LIMIT = 15;

    protected $guarded = []; // YOLO

    public function getBalance()
    {
        return DB::table('expenses')
            ->selectRaw('sum(case when gain then amount else -1*amount end) as totalSum')
            ->selectRaw('sum(case when gain then amount else 0 end) as incomeSum')
            ->selectRaw('sum(case when gain then 0 else amount end) as expenseSum')
            ->where('budget_id', $this->id)
            ->first()
            ;
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function latestExpenses()
    {
        return $this->hasMany(Expense::class)
            ->latest()
            ->take(env('LATEST_LIMIT', self::LATEST_LIMIT))
            ;
    }
}
