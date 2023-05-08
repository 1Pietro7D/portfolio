<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    //protected
    protected $fillable = [
        'user_id', 'name',  "curriculum_vitae_pdf"
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

    public function skills()  {
        return $this->hasMany('App\Models\Skill');
    }

    public function contacts()  {
        return $this->hasMany('App\Models\Contact');
    }

    public function section(){
        return $this->hasOne('App\Models\Section');
    }
}
