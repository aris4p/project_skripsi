<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan</title>
  <link rel="stylesheet" href="{{ asset('asset_admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
</head>
<body>

  <center>
    <h4>LAPORAN NERACA SALDO</h4>
  </center>

  <table style="width: 40%">
    <tr>
      <td width="30%">BULAN</td>
      <td width="5%" class="text-center">:</td>
      <td>{{($_GET['dari']) }}</td>
    </tr>
    <tr>
      <td width="20%">Tahun</td>
      <td width="5%" class="text-center">:</td>
      <td>{{ $_GET['tahun'] }}</td>
    </tr>
  </table>

  <br>

  <table class="table table-bordered table-striped">

    <div class="card">
          
      <br>
          <div class="card-header pt-2">
            <h3 class="card-title text-center">CV. Mitra Warnatama</h3>
            <h3 class="card-title text-center">Neraca Saldo</h3>
        </div>
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
             <th class="text-center">{{ $akun2->reff_akun }}</th>
             <th class="text-center">{{ $akun2->nama_akun }}</th>
             <th class="text-center">{{ ($debit>$kredit)?$debit-$kredit:"-" }}</th>
             <th class="text-center">{{ ($debit<$kredit)?$kredit-$debit:"-"  }}</th>
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
    
  
       
  </table>   


  <script type="text/javascript">
    window.print();
  </script>

</body>
</html>
