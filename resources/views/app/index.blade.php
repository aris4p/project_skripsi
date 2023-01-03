@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="container-fluid mt-3">

    <div class="row">
      <div class="col-lg-3 col-sm-10">
        <div class="card gradient-7">
          <div class="card-body">
            <h4 class="card-title text-white">Pembelian Hari Ini</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($pemasukan_hari_ini->total)." ,-" }}</h4>
              <p class="text-white mb-0">{{ date('d-m-Y') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm6">
        <div class="card gradient-2">
          <div class="card-body">
            <h4 class="card-title text-white">Pembelian Bulan Ini</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($pemasukan_bulan_ini->total)." ,-" }}</h4>
              <p class="text-white mb-0">{{ date('M') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card gradient-3">
          <div class="card-body">
            <h4 class="card-title text-white">Pembelian Tahun Ini</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($pemasukan_tahun_ini->total)." ,-" }}</h4>
              <p class="text-white mb-0">{{ date('Y') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card gradient-4">
          <div class="card-body">
            <h4 class="card-title text-white">Seluruh Pembelian</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($seluruh_pemasukan->total)." ,-" }}</h4>
              <p class="text-white mb-0">Semua</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card gradient-1">
          <div class="card-body">
            <h4 class="card-title text-white">penjualan Hari Ini</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($penjualan_hari_ini->total)." ,-" }}</h4>
              <p class="text-white mb-0">{{ date('d-m-Y') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card gradient-9">
          <div class="card-body">
            <h4 class="card-title text-white">penjualan Bulan Ini</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($penjualan_bulan_ini->total)." ,-" }}</h4>
              <p class="text-white mb-0">{{ date('M') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card gradient-6">
          <div class="card-body">
            <h4 class="card-title text-white">penjualan Tahun Ini</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($penjualan_tahun_ini->total)." ,-" }}</h4>
              <p class="text-white mb-0">{{ date('Y') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card gradient-8">
          <div class="card-body">
            <h4 class="card-title text-white">Seluruh Penjualan</h4>
            <div class="d-inline-block">
              <h4 class="text-white">{{ "Rp. ".number_format($seluruh_penjualan->total)." ,-" }}</h4>
              <p class="text-white mb-0">Semua</p>
            </div>
          </div>
        </div>
      </div>
    </div>


    



</div>
<!-- #/ container -->
</div>





@endsection