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
    <h4>LAPORAN JURNAL UMUM</h4>
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

        
      <div class="card">

            <div class="card-header pt-2">
              <h3 class="card-title text-center">CV. Mitra Warnatama</h3>
              <h3 class="card-title text-center">Jurnal Umum</h3>
          </div>
            <div class="card-body">
          
          <div class="card">
            <table class="table table-bordered">
              <thead>
              
                <tr>
                <th  class="text-center">Tanggal</th>
                  <th  colspan="2" class="text-center">Keterangan</th>
                  <th  class="text-center">Reff</th>
                  <th  class="text-center">Debit</th>
                  <th  colspan="2" class="text-center">Kredit</th>
                  
                </tr>
              </thead>
              <tbody>
                @php
                
                $total_debit = 0;
                $total_kredit = 0;
                @endphp
                @foreach($jurnal as $j)
                <tr>
                <td class="text-center">{{$j->tanggal }}</td>
                <td class="text-center">
                  @if($j->jenis == "debit")
                  {{ $j->akun->nama_akun }}
                  @else
                  {{""}}
                  @endif
                  </td>
                  <td class="text-center">
                  @if($j->jenis == "kredit")
                  {{ $j->akun->nama_akun }}
                  @else
                  {{""}}
                  @endif
                  </td>
                  <td class="text-center">{{$j->akun->reff_akun }}</td>
                  <td class="text-center">
                    @if($j->jenis == "debit")
                    {{ "Rp.".number_format($j->nominal).",-" }}
                    @php $total_debit += $j->nominal; @endphp
                    @else
                    {{ "-" }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if($j->jenis == "kredit")
                    {{ "Rp.".number_format($j->nominal).",-" }}
                    @php $total_kredit += $j->nominal; @endphp
                    @else
                    {{ "-" }}
                    @endif
                  </td>
                
                  

                </tr>
                </tbody>
                @endforeach
              <thead class="bg-info text-white font-weight-bold">
                <tr>
                  <td colspan="4" class="text-bold text-center">TOTAL</td>
                  <td class="text-center">{{ "Rp.".number_format($total_debit).",-" }}</td>
                  <td class="text-center">{{ "Rp.".number_format($total_kredit).",-" }}</td>
                </tr>
               
                <tr>
                @if($total_debit === $total_kredit)
                  <td colspan="6" class="text-bold text-center " style="background-color:green">Seimbang</td>
                @else
                <td colspan="6" class="text-bold text-center " style="background-color:red">Tidak Seimbang</td>
                @endif
                </tr> 

              </thead>
            
            
    
        
        </table>   


  <script type="text/javascript">
    window.print();
  </script>

</body>
</html>
