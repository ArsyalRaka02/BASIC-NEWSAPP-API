<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class users extends Model implements AuthenticatableContract, AuthorizableContract {

    use Authenticatable, Authorizable;

    protected $table = 'tb_user';

    protected $fillable = [
        'id_user', 'username', 'password', 'api_token', 'id_role'
    ];

    protected $hidden = [
        'password'
    ];

}
