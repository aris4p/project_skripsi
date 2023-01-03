@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">
   
   <h3 class="col p-md-0">Neraca Saldo</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Neraca Saldo</a></li>
      </ol>
    </div>
  </div>

  <div class="container-fluid">


    <div class="card">

      <div class="card-header pt-4">
        <h3 class="card-title">Neraca Saldo</h3>
      </div>
      <div class="card-body">

        <form method="GET" action="{{ route('neracasaldo') }}">
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
            <h3 class="card-title">Neraca Saldo</h3>
          </div>
          <div class="card-body">

            <br>
            <br>
            <a target="_BLANK" href="{{ route('neracasaldo_cetak',[ 'dari' => $_GET['dari'], 'tahun' => $_GET['tahun']]) }}" class="btn btn-outline-secondary"><i class="fa fa-print "></i> &nbsp; CETAK PRINT/PDF</a>
           
           <br>
            <br>
        <div class="card">
          
          <br>
              <div class="card-header pt-2">
                <h3 class="card-title text-center">CV. Mitra Warnatama</h3>
                <h3 class="card-title text-center">Neraca Saldo</h3>
            </div>
              <div class="card-body">
            
            <div class="card">
              <table class="table table-bordered">
                <thead>
                
                  <tr>
                  <th  class="text-center">No. Akun</th>
                    <th  class="text-center">Nama Akun</th>
                    <th  class="text-center">Debit</th>
                    <th  class="text-center">Kredit</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @php
                      $total =0;
                      $totalkredit = 0;
                  @endphp
                  </tbody>
                
                 @foreach ($akun as $akun2)
                 <?php 
                 $kredit = 0;
                 $debit=0;
                 $deb=0;
                 $kred=0;
                 
                 ?>
                @foreach ($map as $item)
                    @if ($item['name'] == $akun2->keterangan)
                        @php
                            $kredit = $kredit +$item['kredit'];
                        $debit = $debit +$item['debit'] 
                        @endphp
                    @endif
                @endforeach
                     <tr>
                       <th>{{ $akun2->reff_akun }}</th>
                       <th>{{ $akun2->nama_akun }}</th>
                       @php $deb = ($debit>$kredit)?$debit-$kredit:"-"  @endphp
                       @php $kred = ($debit<$kredit)?$kredit-$debit:"-" @endphp
                       <th class="text-bold text-center">{{ $deb  }}</th>
                       <th class="text-bold text-center">{{ $kred }}</th>
                     </tr>
                     @php
                        $toaldebit = ($debit>$kredit)?$debit-$kredit:0;
                        $totalkredit1 =  ($debit<$kredit)?$kredit-$debit:0;
                         $total = $total +$toaldebit;
                         $totalkredit = $totalkredit +$totalkredit1;
                     @endphp
                     
                 @endforeach
                 
                <tfoot class="bg-info text-white font-weight-bold">
                  <tr>
                    <td colspan="2" class="text-bold text-center">TOTAL</td>
                    <td class="text-center">{{ "Rp.".number_format($total).",-" }}</td>
                    <td class="text-center">{{ "Rp.".number_format($totalkredit).",-" }}</td>
                  </tr>
                  <tr>
                    @if($total === $totalkredit)
                      <td colspan="6" class="text-bold text-center " style="background-color:green">Seimbang</td>
                    @else
                    <td colspan="6" class="text-bold text-center " style="background-color:red">Tidak Seimbang</td>
                    @endif
                    </tr>               
                </tfoot>
              
               @endif
                 
                  </table>   
                  </div>
      </div>

    </div>
  </div>
  <!-- #/ container -->
</div>

@endsection