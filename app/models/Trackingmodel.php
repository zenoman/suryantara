<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Trackingmodel extends Model
{
	public $timestamps = false;
    protected $table = 'status_pengiriman';
    protected $guarded = ['id'];
}