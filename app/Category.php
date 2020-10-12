<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function users(){
        return $this->belongsTo('App\User','id','user_id');
    }
}
