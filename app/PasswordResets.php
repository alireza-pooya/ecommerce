<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];
}
