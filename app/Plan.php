<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Plan extends Model {

    protected $fillable = [
        'name', 'min', 'max', 'percentage', 'compound_id', 'note', 'image', 'ref','withdraw_fee','deposit_fee'
    ];

    public function compound() {
        return $this->belongsTo(Compound::class, 'compound_id');
    }

    public function investment() {
        return $this->hasMany(Investment::class, 'plan_id');
    }

    public function investmentAuth() {
        return $this->hasMany(Investment::class, 'plan_id')->whereUser_id(Auth::user()->id);
    }

}
