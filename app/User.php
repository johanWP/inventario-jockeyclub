<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    protected $table = 'users';
    protected $fillable = ['name', 'last_name', 'email', 'password', 'username', 'position', 'sector_id', 'ext'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }

    /**
     * Devuelve los roles del usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * @param $roles
     * @return Boolean
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role)    {
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        } else
        {
            if($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Devuelve si el usuario tiene un rol especifico
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())  {
            return true;
        }

        return false;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sectors()
    {
//        return $this->hasMany('App\Sector');
    }

    /**
     * Devuelve una coleccion de assets asignados al usuario, ordenados por tipo
     * @return Collection|static
     */
    public function getInventarioAttribute()
   {
       return Asset::where('usuario_actual', $this->id)->orderBy('type_id')->get();
   }

    public function getMovesAttribute()
    {
        return collect(Move::where('origen', $this->id)
            ->orWhere('destino', $this->id)
            ->orderBy('id', 'DESC')->get());
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
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
            return 'Usuario creado por ' . Auth::user()->fullName . ': '. $this->fullName;
        }

        if ($eventName == 'updated')
        {
            return 'Usuario actualizado por ' . Auth::user()->fullName . ': '. $this->fullName;
        }

        if ($eventName == 'deleted')
        {
            return 'Usuario eliminado por ' . Auth::user()->fullName . ': '. $this->fullName;
        }

        return '';
    }
}
