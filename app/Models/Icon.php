<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    //protected
    protected $fillable = [
        'name', 'slug', 'font6_class'
    ];

    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }
}
