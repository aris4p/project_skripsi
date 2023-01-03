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
    <h4 colspan="4">LAPORAN DATA PENJUALAN DAN PEMBELIAN</h4>
  </center>

  <table>
    <tr>
      <td>DARI TANGGAL</td>
      <td>:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
    </tr>
    <tr>
      <td >SAMPAI TANGGAL</td>
      <td >:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
    </tr>
  </table>



  <table>
              <thead>
                <tr>
                
                <th>PEMBELIAN</th>
                
                </tr>
                  <tr>
                    <th >NO</th>
                    <th  >TANGGAL</th>
                    <th >kode transaksi</th>
                    <th >Nama Supplier</th>
                    <th >Nominal</th>
                    <th >metode</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  
                  $total_pengeluaran = 0;
                  @endphp
                  @foreach($pembelian as $pb)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($pb->tanggal )) }}</td>
                    <td>{{ $pb->kode_transaksi }}</td>
                    <td>{{ $pb->supplier->nama }}</td>
                    <td>{{"Rp.".number_format($pb->nominal).",-" }}
                    @php $total_pengeluaran += $pb->nominal; @endphp    
                    </td>
                    <td >{{ $pb->metode }}</td>
                    

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td >Total Pembelian</td>
                    <td >{{ "Rp.".number_format($total_pengeluaran).",-" }}</td>
                                      
                  </tr>
    </table>    
        <table>
        <thead>
                <tr>
                
                <th>PENJUALAN</th>
                
                </tr>
                  <tr>
                    <th >NO</th>
                    <th >TANGGAL</th>
                    <th >kode transaksi</th>
                    <th >Nama Customer</th>
                    <th >Nominal</th>
                    <th >metode</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  $total_pemasukan = 0;
                 
                  @endphp
                  @foreach($penjualan as $t)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($t->tanggal )) }}</td>
                    <td>{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->customer->nama}}</td>
                    <td>{{ "Rp.".number_format($t->nominal).",-" }}
                    @php $total_pemasukan += $t->nominal; @endphp                    
                    </td>
                    <td>{{ $t->metode }}</td>
                   
                    
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                 <tr>
                  <td>Total Penjualan</td>
                    <td >{{ "Rp.".number_format($total_pemasukan).",-" }}</td>
                    
                
                  </tr>
                </tfoot>
              </table>
            
        @php  $total_akhir = $total_pemasukan-$total_pengeluaran; @endphp  
              <table >       
                <tfoot>
                  <tr>
                    <td >Selisih uang Penjualan Dan Pembelian</td>  
                    </tr>
                    @if($total_akhir >= 0)
                    <tr>
                    <td >{{ "Rp.".number_format($total_akhir).",-" }}</td>
                    </tr>
                    <tr>
                      <td > Perusahaan Mengalami Keuntungan </td>
                    </tr>  
                    @else
                    <tr>
                      <td>{{ "Rp.".number_format($total_akhir).",-" }}</td>
                    </tr>
                    <tr>
                      <td > Perusahaan Mengalami Kerugian </td>
                    </tr>
                    @endif
                </tfoot>
              </table>

</body>
</html>
