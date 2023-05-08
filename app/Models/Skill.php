<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //protected
     protected $fillable = [
        'portfolio_id', 'name', 'slug', "icon_path"
    ];
    // relations
    public function portfolio(){
        return $this->belongsTo('App\Models\Portfolio');
    }

    public function projects(){
        return $this->belongsToMany('App\Models\Project');
    }
}
