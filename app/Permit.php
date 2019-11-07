<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
	protected $table = 'permissions';
    public function worker(){
        return $this->belongsTo('App\Worker');
    }
}
