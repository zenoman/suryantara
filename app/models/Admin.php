<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $table="admin";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded= [
        'id'];

    
}
