<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Trf_lautmodel extends Model
{
	public $timestamps = false;
    protected $table = 'tarif_laut';
    protected $guarded = ['id'];
}