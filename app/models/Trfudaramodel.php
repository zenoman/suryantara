<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Trfudaramodel extends Model
{
	public $timestamps = false;
    protected $table = 'tarif_udara';
    protected $guarded = ['id'];
}