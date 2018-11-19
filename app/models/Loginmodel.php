<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Loginmodel extends Model
{
	public $timestamps = false;
    protected $table = 'admin';
    protected $guarded = ['id'];
}