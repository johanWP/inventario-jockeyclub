<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    protected $table = 'areas';
    protected $fillable = ['name', 'description', 'email', 'office_id'];

    public function sectors()
    {
        return $this->hasMany('App\Sector')->orderBy('name');
    }

    public function manager()
    {
//        return $this->belongsTo('App\User', 'user_id');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Sector')->where('user_type', 'U')->orderBy('name');
    }

}
