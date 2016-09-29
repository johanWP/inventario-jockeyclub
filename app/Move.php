<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
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

}
