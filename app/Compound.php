<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
  protected $fillable = [
        'name', 'compound','compound_turn_over',
    ];
}
