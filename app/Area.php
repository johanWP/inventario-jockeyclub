<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
//Este array debe mantenerse consistente con el test
    protected $fillable = ['name', 'description', 'email', 'fax', 'sector_id'];
    protected $table = 'areas';
    
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }
}
