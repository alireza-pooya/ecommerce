<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'content',
        'response',
        'email',
        'mobile',
        'full_name',
    ];
}
