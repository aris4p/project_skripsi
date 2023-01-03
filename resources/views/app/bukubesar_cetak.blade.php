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

        
        @foreach($akun as $ak)
                 
        <table  class="table table-bordered" id="table-datatable">
       
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
      
          <thead>
            @php
            $no = 1;
            $total_debit = 0;
          
            @endphp
            @foreach ($jurnal as $jur)
            <tr>
            @if($jur->kode_id == $ak->id )
              <td class="text-center">{{ $no++ }}</td>
              <td class="text-center">{{ date('d-m-Y', strtotime($jur->tanggal )) }} </td>
              <td class="text-center">{{ $jur->akun->nama_akun}} </td>
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
            </thead>
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

  <script type="text/javascript">
    window.print();
  </script>

</body>
</html>
