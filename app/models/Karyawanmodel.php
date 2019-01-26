<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Karyawanmodel extends Model
{
	public $timestamps = false;
    protected $table = 'karyawan';
    protected $guarded = ['id'];
}