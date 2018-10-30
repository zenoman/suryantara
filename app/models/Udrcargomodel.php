<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Udrcargomodel extends Model
{
	public $timestamps = false;
    protected $table = 'udara_kargo';
    protected $guarded = ['id'];
}