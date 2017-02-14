<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;



class Alimento extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    
use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**ffffff
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alimento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo','nombre','tipo_gallina','estado'];
    protected $dates=['deleted_at'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */


    }
