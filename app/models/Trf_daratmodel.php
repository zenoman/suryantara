<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Trf_daratmodel extends Model
{
	public $timestamps = false;
    protected $table = 'tarif_darat';
    protected $guarded = ['id'];
}