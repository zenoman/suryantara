<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Katbarmodel extends Model
{
	public $timestamps = false;
    protected $table = 'kategori_barang';
    protected $guarded = ['id'];
}