<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Vendormodel extends Model
{
	public $timestamps = false;
    protected $table = 'vendor';
    protected $guarded = ['id'];
}