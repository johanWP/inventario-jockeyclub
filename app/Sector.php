<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use SoftDeletes;
    protected $table = 'sectors';
    protected $fillable = ['name', 'description', 'email', 'office_id'];
    
    public function areas()
    {
        return $this->hasMany('App\Area')->orderBy('name');
    }

    public function manager()
    {
//        return $this->belongsTo('App\User', 'user_id');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Area')->orderBy('name');
    }


}
