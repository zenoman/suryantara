<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Laporakunmodel extends Model
{
	public $timestamps = false;
    protected $table = 'pengeluaran_lain';
    protected $guarded = ['id'];
}