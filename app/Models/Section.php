<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //protected
    protected $fillable = [
        'portfolio_id', 'title', 'slug', 'paragraph', 'img_path'
    ];
    // relations
    public function portfolio(){
        return $this->belongsTo('App\Models\Portfolio');
    }
}
