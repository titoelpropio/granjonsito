<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes;

class VacunaGalpon extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
   use Authenticatable, Authorizable, CanResetPassword,SoftDeletes;

 protected $table = 'galpon_vacuna';



 protected $fillable = ['id','id_galpon','id_vacuna', 'fecha'];

protected $dates = ['deleted_at'];

	public function scopeBusqueda($query,$id){
		$query->where('id',$id);
	}
}
