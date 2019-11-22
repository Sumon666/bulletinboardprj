<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    //password_resets table
    public $table = "password_resets";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token', 'created_at', 'updated_at',
    ];
}
