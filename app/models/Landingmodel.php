<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Landingmodel extends Model
{
	public $timestamps = false;
    protected $table = 'setting';
    protected $guarded = ['id'];
}
