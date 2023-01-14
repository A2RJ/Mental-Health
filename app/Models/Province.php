<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
	protected $table = "provinces";
	protected $primaryKey = 'prov_id';
	public $timestamps = false;

	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id', 'country_id');
	}
}
