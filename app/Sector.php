<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use Illuminate\Support\Facades\Auth;

class Sector extends Model implements LogsActivityInterface
{
    use SoftDeletes, LogsActivity;
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
            return 'Sector creado por ' . Auth::user()->fullName . ': '. $this->name;
        }

        if ($eventName == 'updated')
        {
            return 'Sector actualizado por ' . Auth::user()->fullName . ': '. $this->name;
        }

        if ($eventName == 'deleted')
        {
            return 'Sector eliminado por ' . Auth::user()->fullName . ': '. $this->name;
        }

        return '';
    }
}

// Cambiado