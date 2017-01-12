<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Asset extends Model implements LogsActivityInterface
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'assets';
    protected $fillable = [
        'serial', 'marca', 'modelo', 'fechaCompra', 'precio',
        'nota', 'status', 'user_id', 'type_id'
    ];
    protected $dates = ['fechaCompra'];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function moves()
    {
        return $this->hasMany('App\Move');
    }

    /** Se asegura de que el formato en que se guarda fechaCompra en la base de datos
     * sea de forma: yyyy/mm/dd 00:00:00
     * @param $value
     */
    public function setFechaCompraAttribute($value)
    {
        $this->attributes['fechaCompra'] = date_format(date_create($value), "Y/m/d H:i:s");
    }

    /** Toma la fecha guardada en la base de datos y la formatea de forma 3-Jan-2001
     * @param $value
     * @return string
     */
    public function getFechaCompraAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-M-Y');
    }

    /**
     * @return boolean
     */
    public function getOwnerAttribute()
    {
        $lastMove = Move::orderBy('id', 'desc')->first();
        return User::find($this->usuario_actual);
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
            return 'El equipo serial "' . $this->serial . '" se creó';
        }

        if ($eventName == 'updated')
        {
            return 'El equipo "' . $this->serial . '" se actualizó';
        }

        if ($eventName == 'deleted')
        {
            return 'El equipo "' . $this->serial . '" se eliminó';
        }
        return '';
    }


}
