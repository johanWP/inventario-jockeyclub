<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Move extends Model implements LogsActivityInterface

{
    use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'moves';

    /**
     * The attributes that are mass assignable.
     * Mantener sincronizados con el test
     * @var array
     */
    protected $fillable = ['origen','destino', 'asset_id', 'user_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }
    
    public function usuarioOrigen()
    {
        return $this->belongsTo('App\User', 'origen');
    }
    public function usuarioDestino()
    {
        return $this->belongsTo('App\User', 'destino');
    }

    public function hechoPor()
    {
        return $this->belongsTo('App\User', 'user_id');
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
            return 'El equipo serial "' . $this->asset->serial . '" se transfirió de '.$this->usuarioOrigen->name.' a '.$this->usuarioDestino->name;
        }

        if ($eventName == 'updated')
        {
            return 'Corrección: El equipo serial "' . $this->asset->serial . '" se transfirió de '.$this->usuarioOrigen.' a '.$this->usuarioDestino;
        }

        if ($eventName == 'deleted')
        {
            return 'Eliminación: El equipo serial "' . $this->asset->serial . '" se transfirió de '.$this->usuarioOrigen.' a '.$this->usuarioDestino;
        }

        return '';
    }

}
