<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = "akuns";

	protected $fillable = [
        'reff_akun', 'nama_akun', 'keterangan'
    ];

    
  /**
   * Get all of the jurnal for the Akun
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function jurnal()
  {
      return $this->hasMany(Jurnal::class,'kode_id','id');
  }
}



