<?php

namespace App;

use Illuminate\Auth\Authenticatable;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsumoVacunaEmergente extends  Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
 use Authenticatable, Authorizable, CanResetPassword;
 use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consumo_emergente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_edad','id_vacuna','cantidad','precio','estado'];
    protected $dates = ['deleted_at'];

}
