<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Manualmodel extends Model
{
	public $timestamps = false;
    protected $table = 'resi_pengiriman';
    protected $guarded = ['id'];
}