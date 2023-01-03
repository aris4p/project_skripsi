@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">
   
   <h3 class="col p-md-0">Laporan Penjualan dan Pembelian</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Laporan</a></li>
      </ol>
    </div>
  </div>

  <div class="container-fluid">


    <div class="card">

      <div class="card-header pt-4">
        <h3 class="card-title">Filter Laporan</h3>
      </div>
      <div class="card-body">

        <form method="GET" action="{{ route('rekapdata') }}">
          @csrf
          <div class="row">

            <div class="col-lg-offset-2 col-lg-3">
              <div class="form-group">
                <label>Dari Tanggal</label>
                <input class="form-control datepicker2" placeholder="Dari Tanggal" type="text" required="required" name="dari" value="<?php if(isset($_GET['dari'])){echo $_GET['dari'];} ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Sampai Tanggal</label>
                <input class="form-control datepicker2" placeholder="Sampai Tanggal" type="text" required="required" name="sampai" value="<?php if(isset($_GET['sampai'])){echo $_GET['sampai'];} ?>">
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Tampilkan" style="margin-top: 25px">
              </div>
            </div>

          </div>

        </form>
        <br>
      </div>

    </div>

         @if(isset($_GET['dari']))
  
        <div class="card">

          <div class="card-header pt-4">
            <h3 class="card-title">Data Laporan Keuangan</h3>
          </div>
          <div class="card-body">

            <table style="width: 50%">
              <tr>
                <th width="25%">DARI TANGGAL</th>
                <th width="5%" class="text-center">:</th>
                <td>{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
              </tr>
              <tr>
                <th width="25%">SAMPAI TANGGAL</th>
                <th width="5%" class="text-center">:</th>
                <td>{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
              </tr>
             
            </table>

            <br>
            <br>
            <a target="_BLANK" href="{{ route('rekapdata_cetak',[ 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}" class="btn btn-outline-secondary"><i class="fa fa-print "></i> &nbsp; CETAK PRINT/PDF</a>
            <a target="_BLANK" href="{{ route('rekapdata_excel',[ 'dari' => $_GET['dari'], 'sampai' => $_GET['sampai']]) }}" class="btn btn-outline-secondary"><i class="fa fa-print "></i> &nbsp; CETAK EXCEL</a>
           <br>
            <br>
            <br>
        
            <div class="card">
              <table class="table table-bordered">
                <thead>
                <tr>
                
                <th colspan="8" class="text-center" width="10%">PEMBELIAN</th>
                
                </tr>
                  <tr>
                    <th  class="text-center" width="1%">NO</th>
                    <th  class="text-center" width="9%">TANGGAL</th>
                    <th  class="text-center">kode pembelian</th>
                    <th  class="text-center">Nama Supplier</th>
                    <th  class="text-center">Nominal</th>
                    <th  class="text-center">metode</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  
                  $total_pengeluaran = 0;
                  @endphp
                  @foreach($pembelian as $pb)
                  <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ date('d-m-Y', strtotime($pb->tanggal )) }}</td>
                    <td class="text-center">{{ $pb->kode_transaksi }}</td>
                    <td class="text-center">{{ $pb->supplier->nama }}</td>
                    <td class="text-center">{{"Rp.".number_format($pb->nominal).",-" }}
                    @php $total_pengeluaran += $pb->nominal; @endphp    
                    </td>
                    <td class="text-center">{{ $pb->metode }}</td>
                    

                  </tr>
                  @endforeach
                </tbody>
                <tfoot class="bg-info text-white font-weight-bold">
                  <tr>
                    <td colspan="4" class="text-bold text-right text-center">Total Pembelian</td>
                    <td colspan="3" class="text-center">{{ "Rp.".number_format($total_pengeluaran).",-" }}</td>
                    
                   
                  </tr>
              
            </div>

          </div>

        </div>

        <div class="card">
              <table class="table table-bordered">
                <thead>
                <tr>
                
                <th colspan="8" class="text-center" width="10%">PENJUALAN</th>
                
                </tr>
                  <tr>
                    <th  class="text-center" width="1%">NO</th>
                    <th  class="text-center" width="9%">TANGGAL</th>
                    <th  class="text-center">kode Penjualan</th>
                    <th  class="text-center">Nama Customer</th>
                    <th  class="text-center">Nominal</th>
                    <th  class="text-center">metode</th>
                  
                  </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  $total_pemasukan = 0;
                 
                  @endphp
                  @foreach($penjualan as $t)
                  <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                    <td class="text-center">{{ $t->kode_transaksi }}</td>
                    <td class="text-center">{{ $t->customer->nama}}</td>
                    <td class="text-center">{{ "Rp.".number_format($t->nominal).",-" }}
                    @php $total_pemasukan += $t->nominal; @endphp                    
                    </td>
                    <td class="text-center">{{ $t->metode }}</td>
                   
                    
                  </tr>
                  @endforeach
                </tbody>
                <tfoot class="bg-info text-white font-weight-bold">
                  <tr>
                    <td colspan="4" class="text-bold text-right text-center">Total Penjualan</td>
                    <td colspan="3" class="text-center">{{ "Rp.".number_format($total_pemasukan).",-" }}</td>
                    
                
                  </tr>
                </tfoot>
              </table>
            </div>

          
        </div>

            @php  $total_akhir = $total_pemasukan-$total_pengeluaran; @endphp  
              <table class="table">       
                <tfoot class="bg-info text-white font-weight-bold">
                  <tr>
                    <td colspan="4" class="text-bold text-right text-center">Selisih Total Penjualan Dan Pembelian</td>  
                    <td  class="text-center">{{ "Rp.".number_format($total_akhir).",-" }}</td>
                  </tr>
                </tfoot>
              </table>
     
  @endif

  </div>
  <!-- #/ container -->
</div>

@endsection