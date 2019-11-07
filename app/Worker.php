<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function vacations(){
        return $this->hasMany('App\Vacation');
    }
    public function permissions(){
        return $this->hasMany('App\Permit');
    }
    //Query Scope

    public function scopeName($query, $name)
    {
        if($name)
            return $query->where('name', 'LIKE', "%$name%");
    }
}
