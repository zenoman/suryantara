<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Landingdaratmodel extends Model
{
	public $timestamps = false;
    protected $table = 'tarif_darat';
    protected $guarded = ['id'];
}
