<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kategoriakutansi extends Model
{
	public $timestamps = false;
    protected $table = 'tb_kategoriakutansi';
    protected $guarded = ['id'];
}