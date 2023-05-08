<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //protected
    protected $fillable = [
        'portfolio_id', 'title', 'slug', "description", "img_path", "video_path", "link_github"
    ];

    public function portfolio(){
        return $this->belongsTo('App\Models\Portfolio');
    }

    public function skills(){
        return $this->belongsToMany('App\Models\Skill');
    }
}
