<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Jabatanmodel extends Model
{
	public $timestamps = false;
    protected $table = 'jabatan';
    protected $guarded = ['id'];
}