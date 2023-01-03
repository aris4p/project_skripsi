<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = "penjualans";

	protected $fillable = [
        'tanggal', 'kode_transaksi', 'customer_id', 'nominal', 'metode','Keterangan','status'
    ];


    public function customer()
	{
		return $this->belongsTo('App\Customer');
	}



}

