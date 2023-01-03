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
    <h4>LAPORAN DATA PENJUALAN DAN PEMBELIAN</h4>
  </center>

  <table style="width: 40%">
    <tr>
      <td width="30%">DARI TANGGAL</td>
      <td width="5%" class="text-center">:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['dari'])) }}</td>
    </tr>
    <tr>
      <td width="20%">SAMPAI TANGGAL</td>
      <td width="5%" class="text-center">:</td>
      <td>{{ date('d-m-Y',strtotime($_GET['sampai'])) }}</td>
    </tr>
  </table>

  <br>

  <table class="table table-bordered table-striped">
              <thead>
                <tr>
                
                <th colspan="8" class="text-center" width="10%">PEMBELIAN</th>
                
                </tr>
                  <tr>
                    <th  class="text-center" width="1%">NO</th>
                    <th  class="text-center" width="9%">TANGGAL</th>
                    <th  class="text-center">kode transaksi</th>
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

        <table class="table table-bordered table-striped">
        <thead>
                <tr>
                
                <th colspan="8" class="text-center" width="10%">PENJUALAN</th>
                
                </tr>
                  <tr>
                    <th  class="text-center" width="1%">NO</th>
                    <th  class="text-center" width="9%">TANGGAL</th>
                    <th  class="text-center">kode transaksi</th>
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
                    <td colspan="4" class="text-bold text-right text-center">Selisih uang Penjualan Dan Pembelian</td>  
                    <td  class="text-center">{{ "Rp.".number_format($total_akhir).",-" }}</td>
                   
                </tfoot>
              </table>


  <script type="text/javascript">
    window.print();
  </script>

</body>
</html>
