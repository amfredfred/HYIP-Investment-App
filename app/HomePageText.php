<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePageText extends Model
{
  protected $fillable = [
        'title', 'description','video_text', 'get_start_text', 'why_us_text', 'photo', 'about_us_photo', 'get_start_text_image','benefit_text','get_beneift_text'
    ];
}
