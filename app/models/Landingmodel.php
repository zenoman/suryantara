<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Landingmodel extends Model
{
	public $timestamps = false;
    protected $table = 'admin';
    protected $guarded = ['id'];
}