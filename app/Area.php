<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use Illuminate\Support\Facades\Auth;

class Area extends Model implements LogsActivityInterface
{
    use SoftDeletes, LogsActivity;
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

    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        if ($eventName == 'created')
        {
            return 'Área creada por ' . Auth::user()->fullName . ': '. $this->name;
        }

        if ($eventName == 'updated')
        {
            return 'Área actualizada por ' . Auth::user()->fullName . ': '. $this->name;
        }

        if ($eventName == 'deleted')
        {
            return 'Área eliminada por ' . Auth::user()->fullName . ': '. $this->name;
        }

        return '';
    }

}
