<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use UsesUuid;

    protected $guarded = []; // YOLO

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function initials()
    {
        return Str::substr($this->name, 0, 1);
    }

    public function defaultBudget()
    {
        return $this->belongsTo(Budget::class, 'default_budget_id');
    }
}
