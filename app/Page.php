<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {


    protected $fillable = [
        'title', 'slug', 'description', 'col1', 'col2', 'col3'
    ];
 public function getAbout() {
        return str_limit(strip_tags($this->description), 400, '...');
    }
}
