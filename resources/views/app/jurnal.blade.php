@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">Jurnal</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Jurnal</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <a href="{{ route('jurnal.tambah') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> &nbsp Tambah Jurnal</a>
        <h4>Input Jurnal</h4>

      </div>
      <div class="card-body pt-0">

    
        <div class="table-responsive">

          <table class="table table-bordered" id="table-datatable">
            <thead>
              <tr>
                <th rowspan="2" width="1%">NO</th>
                <th rowspan="2" class="text-center">Tanggal</th>
                <th rowspan="2" class="text-center">Keterangan</th>
                <th rowspan="2" class="text-center">No.Reff</th>
                <th colspan="2" class="text-center">Jenis</th>
               
                <th rowspan="2" class="text-center" width="10%">OPSI</th>
              </tr>
              <tr>
                <th class="text-center">Debit</th>
                <th class="text-center">Kredit</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($jurnal as $j)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($j->tanggal )) }} </td>
                <td class="text-center">{{ $j->akun->nama_akun}}</td>
                <td class="text-center">{{ $j->akun->reff_akun}}</td>
                <td class="text-center">
                  
                  @if($j->jenis == "debit")
                  {{ "Rp.".number_format($j->nominal).",-" }}
                  @else
                  {{ "-" }}
                  @endif
                </td>
                <td class="text-center">
                  @if($j->jenis == "kredit")
                  {{ "Rp.".number_format($j->nominal).",-" }}
                  @else
                  {{ "-" }}
                  @endif
                </td>
               
                <td>
                  @if($j->id != 0)
                <div class="text-center">
                  <a href="{{ route('jurnal.edit', ['id' => $j->id]) }}" class="btn btn-default btn-sm">
                    <i class="fa fa-cog"></i>
                  </a>

                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_user_{{ $j->id }}">
                    <i class="fa fa-trash"></i>
                  </button>
                @endif
                </div>

                <!-- modal hapus -->
                <form method="POST" action="{{ route('jurnal.delete',['id' => $j->id]) }}">
                  <div class="modal fade" id="hapus_user_{{$j->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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