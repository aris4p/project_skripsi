@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">Buku Besar</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Buku Besar</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
       
        <h4>Buku Besar</h4>

      </div>
      <div class="card-body pt-0">

        <form method="GET" action="{{ route('bukubesar') }}">
          @csrf
          <div class="row">

            <div class="col-lg-offset-2 col-lg-3">
              <div class="form-group">

                <select style="cursor:pointer;margin-top:1.5em;margin-bottom:1.5em;" class="form-control" id="dari" name="dari">
                <option value="0" selected> Pilih Bulan</option>
                  <?php for( $m=1; $m<=12; ++$m ) { 
                  $month_label = date('m', mktime(0, 0, 0, $m, 1));
                  $nama_bulan = date('F', mktime(0, 0, 0, $m, 1));
                  ?>
                <option value="<?php echo $month_label; ?>"><?php echo $nama_bulan; ?></option>
                <?php } ?>
              
              </select>            
              </div>
                  </div>
              <div class="col-lg-3">        
              <div class="form-group">

                <select style="cursor:pointer;margin-top:1.5em;margin-bottom:1.5em;" class="form-control" id="tahun" name="tahun">
                <option value="0" selected> Pilih tahun</option>
                <?php 
                $year = date('Y');
                $min = $year - 5;
                    $max = $year;
                for( $i=$max; $i>=$min; $i-- ) {
                echo '<option value='.$i.'>'.$i.'</option>';
            }?>

                </select> 
                           
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
        <h3 class="card-title">Buku Besar</h3>
      </div>
      <div class="card-body">

        <br>
        <br>
        <a target="_BLANK" href="{{ route('bukubesar_cetak',[ 'dari' => $_GET['dari'], 'tahun' => $_GET['tahun']]) }}" class="btn btn-outline-secondary"><i class="fa fa-print "></i> &nbsp; CETAK PRINT/PDF</a>
       
       <br>
        <br>
    <div class="card">
      
      <br>
          <div class="card-header pt-2">
            <h3 class="card-title text-center">CV. Mitra Warnatama</h3>
            <h3 class="card-title text-center">Buku Besar</h3>
        </div>
          <div class="card-body">
          @foreach($akun as $ak)
                 
          <table class="table table-bordered" id="table-datatable">
         
            <thead>
                <tr>
                    <th style="font-size:30px" colspan="8" class="text-center">{{$ak->nama_akun}}</th>
                </tr>
              <tr>
                <th rowspan="2" width="1%">NO</th>
                <th rowspan="2" class="text-center">Tanggal</th>
                <th rowspan="2" class="text-center">Keterangan</th>
                <th colspan="2" class="text-center">Jenis</th>
                <th colspan="2" class="text-center">Saldo</th>
              </tr>
              <tr>
                <th class="text-center">Debit</th>
                <th class="text-center">Kredit</th>
                
              </tr>
             
            </thead>
        
            <tbody>
              @php
              $no = 1;
              $total_debit = 0;
            
              @endphp
              @foreach ($jurnal as $jur)
              <tr>
              @if($jur->kode_id == $ak->id )
                <td class="text-center">{{ $no++ }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($jur->tanggal )) }} </td>
                <td class="text-center">{{ $jur->keterangan}} </td>
                <td class="text-center">
                  
                  @if($jur->jenis == "debit")
                  {{ "Rp.".number_format($jur->nominal).",-" }}
                  @else
                  {{ "-" }}
                  @endif
                </td>
                <td class="text-center">
                 @if($jur->jenis == "kredit")
                  {{ "Rp.".number_format ($jur->nominal).",-" }}
                  @else
                  {{ "-" }}
                  @endif
                </td>
                <td colspan="2" class="text-center">
                @if($jur->jenis == "kredit" )
                @php $total_debit -= $jur->nominal; @endphp  
                {{ "Rp.".number_format(abs($total_debit)).",-" }}
                  @elseif($jur->jenis ==  "debit")
                  @php $total_debit += $jur->nominal; @endphp 
                  {{ "Rp.".number_format(abs($total_debit)).",-" }}
                  @else
                  {{""}} 
               
                 
             
                 
                
                
                  @endif
                
                </td>
            
             @endif
           
             @endforeach
             <tbody class="bg-info text-white font-weight-bold">
                  <tr>
                    <td colspan="5" class="text-bold text-right text-center">Total</td> 
                    <td  class="text-bold text-right text-center"> {{ "Rp.".number_format(abs($total_debit)).",-" }}</td>
                     
                  </tr>
             
            </tbody>
        
        </table>
        @endforeach
        @endif
        </div>
      </div>

    </div>





  </div>
  <!-- #/ container -->
</div>

@endsection