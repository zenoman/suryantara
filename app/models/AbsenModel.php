<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Absenmodel extends Model
{
	public $timestamps = false;
    protected $table = 'absensi';
    protected $guarded = ['id'];
}