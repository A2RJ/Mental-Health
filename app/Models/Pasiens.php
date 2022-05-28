<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasiens extends Model
{
	protected $table = "pasiens";
	protected $primaryKey = 'pasien_id';
	public $timestamps = true;
}
