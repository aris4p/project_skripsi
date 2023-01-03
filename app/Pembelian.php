<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelians";

	protected $fillable = [
        'tanggal', 'kode_transaksi', 'supplier_id', 'nominal', 'metode','Keterangan','status'
    ];

    public function supplier()
	{
		return $this->belongsTo('App\Supplier');
	}



}

