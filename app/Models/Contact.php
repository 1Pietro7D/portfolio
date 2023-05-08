<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //protected
    protected $fillable = [
        'portfolio_id','icon_id', 'name', 'slug', 'contact'
    ];

    public function portfolio(){
        return $this->belongsTo('App\Models\Portfolio');
    }

    public function icon(){
        return $this->belongsTo('App\Models\Icon');
    }

}
