<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Penyusutan extends Model
{
	public $timestamps = false;
    protected $table = 'penyusutan';
    protected $guarded = ['id'];
}