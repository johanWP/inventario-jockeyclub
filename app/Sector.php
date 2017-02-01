<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use SoftDeletes;
//Este array debe mantenerse consistente con el test
    protected $fillable = ['name', 'description', 'email', 'fax', 'area_id'];
    protected $table = 'sectors';

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

}

// Cambiado