<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class social extends Model
{
  protected $fillable = [
        'name', 'link','icon','status'
    ];
}
