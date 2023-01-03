<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "suppliers";

	protected $fillable = [
        'nama', 'no_telepon', 'email', 'jenis', 'alamat','kota','status'
    ];

    public function pembelian()
	{
		return $this->hasMany('App\Pembelian');
	}

}

