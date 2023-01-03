@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">penjualan</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">penjualan</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">
  
      <div class="card-header pt-4">
        @if(Auth::user()->level == "admin" || Auth::user()->level == "bendahara" )
        <a href="{{ route('penjualan.tambah') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> &nbsp TAMBAH penjualan</a>
        @endif
        <h4>Data penjualan</h4>

      </div>
      <div class="card-body pt-0">

    
        <div class="table-responsive">

          <table class="table table-bordered" id="table-datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>Tanggal</th>
                <th class="text-center">Kode Transaksi</th>
                <th class="text-center">Nama Customer</th>
                <th class="text-center">Nominal</th>
                <th class="text-center">Metode</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($penjualan as $p)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($p->tanggal )) }}     </td>
                <td class="text-center">{{ $p->kode_transaksi }}</td>
                <td class="text-center">{{ $p->customer->nama }}</td>                      
                <td class="text-center">{{ $p->nominal }}</td>
                <td class="text-center">{{ $p->metode }}</td>
                <td class="text-center">{{ $p->Keterangan }}</td>
                <td>    

                  <div class="text-center">
                    <a href="{{ route('penjualan.edit', ['id' => $p->id]) }}" class="btn btn-default btn-sm">
                      <i class="fa fa-cog"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_user_{{ $p->id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                    </div>

                   <!-- modal hapus -->
                   <form method="POST" action="{{ route('penjualan.delete',['id' => $p->id]) }}">
                    <div class="modal fade" id="hapus_user_{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <p>Yakin ingin menghapus data ini ?</p>

                            @csrf
                            {{ method_field('DELETE') }}


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Ya, Hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>



                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>





  </div>
  <!-- #/ container -->
</div>

@endsection