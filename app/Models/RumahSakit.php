<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
	protected $table = "location_rs";
	protected $primaryKey = 'rs_id';
	public $timestamps = true;
}
