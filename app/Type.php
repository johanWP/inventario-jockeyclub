<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $fillable = ['name', 'prefix'];
    
    public function assets()
    {
        return $this->hasMany('App\Asset');
    }
}
