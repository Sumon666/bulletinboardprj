<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token', 'created_at', 'updated_at',
    ];

    //password_resets table
    public $table = 'password_resets';
}
