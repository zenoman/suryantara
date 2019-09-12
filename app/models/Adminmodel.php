<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Adminmodel extends Model
{
	public $timestamps = false;
    protected $table = 'users';
    protected $guarded = ['id'];
}