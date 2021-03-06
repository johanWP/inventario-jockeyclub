<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Asset extends Model implements LogsActivityInterface
{
    use SoftDeletes, LogsActivity;

    protected $table = 'assets';
    protected $fillable = [
        'serial', 'marca', 'modelo', 'fechaCompra', 'precio', 'nota', 'status', 'user_id', 'type_id', 
        'sistema_operativo', 'disco_duro', 'procesador', 'motherboard', 'serial_fabricante'
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
            return 'Equipo creado por ' . Auth::user()->fullName . ': '. $this->name;
        }

        if ($eventName == 'updated')
        {
            return 'Equipo actualizado por ' . Auth::user()->fullName . ': '. $this->name;
        }

        if ($eventName == 'deleted')
        {
            return 'Equipo eliminado por ' . Auth::user()->fullName . ': '. $this->name;
        }

        return '';
    }

    public function getNombreSistemaOperativoAttribute()
    {
        $nombre = collect(DB::select('select valor from pc_caracteristicas where id=' . $this->sistema_operativo))->first();
        (strlen($nombre->valor) > 0) ? $valor = $nombre->valor : $valor = '';
        return $valor;
    }    
    
    public function getNombreProcesadorAttribute()
    {
        $nombre = collect(DB::select('select valor from pc_caracteristicas where id=' . $this->procesador))->first();
        (strlen($nombre->valor) > 0) ? $valor = $nombre->valor : $valor = '';
        return $valor;
    }    
    
    public function getNombreDiscoDuroAttribute()
    {
        $nombre = collect(DB::select('select valor from pc_caracteristicas where id=' . $this->disco_duro))->first();
        (strlen($nombre->valor) > 0) ? $valor = $nombre->valor : $valor = '';
        return $valor;
    }    
    
    public function getNombreMotherboardAttribute()
    {
        $nombre = collect(DB::select('select valor from pc_caracteristicas where id=' . $this->motherboard))->first();
        (strlen($nombre->valor) > 0) ? $valor = $nombre->valor : $valor = 'N/A';
        return $valor;
    }

    
}
