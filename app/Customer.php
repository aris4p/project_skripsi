<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

	protected $fillable = [
        'nama', 'no_telepon', 'email', 'jenis', 'alamat','kota','status'
    ];

    public function penjualan()
	{
		return $this->hasMany('App\Penjualan');
	}
}

