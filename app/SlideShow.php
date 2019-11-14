<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    protected $fillable = [
      'title',
      'body',
      'image',
      'link',
      'start_show',
      'end_show',
    ];
}
