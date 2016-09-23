<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'position', 'email', 'ext', 'area_id'];
    protected $table = 'users';

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
