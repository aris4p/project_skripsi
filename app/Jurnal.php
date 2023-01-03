<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = "jurnals";

	protected $fillable = [
        'tanggal', 'kode_id', 'jenis', 'nominal','keterangan'
    ];

    
   /**
    * Get the akun that owns the Jurnal
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function akun()
   {
       return $this->belongsTo(Akun::class,'kode_id','id');
   }
}

