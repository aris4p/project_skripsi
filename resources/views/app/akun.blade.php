@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">Akun</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Akun</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-plus"></i> &nbsp TAMBAH AKUN
        </button>
        <h4>Data Akun</h4>

      </div>
      <div class="card-body pt-0">

        <!-- Modal -->
        <form action="{{ route('akun.aksi') }}" method="post">
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  @csrf
                  <div class="form-group">
                    <label>Kode Akun</label>
                    <input type="text" name="kode_akun" required="required" class="form-control" placeholder="Kode Akun ..">
                  </div>
                  <div class="form-group">
                    <label>Nama Akun</label>
                    <input type="text" name="nama_akun" required="required" class="form-control" placeholder="Nama Akun ..">
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" required="required" class="form-control" placeholder="Keterangan..">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>


        <div class="table-responsive">


          <table class="table table-bordered" id="table-datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>KODE AKUN</th>
                <th>NAMA AKUN</th>
                <th>Keterangan</th>
                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($akun as $a)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $a->reff_akun }}</td>
                <td>{{ $a->nama_akun }}</td>
                <td>{{ $a->keterangan }}</td>
                
                <td>    

                  @if($a->id != 0)
                  <div class="text-center">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit_akun_{{ $a->id }}">
                      <i class="fa fa-cog"></i>
                    </button>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_akun_{{ $a->id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  @endif

                  <form action="{{ route('akun.update',['id' => $a->id]) }}" method="post">
                    <div class="modal fade" id="edit_akun_{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group" style="width:100%">
                              <label>Kode Akun</label>
                              <input type="hidden" name="id" value="{{ $a->id }}">
                              <input type="text" name="reff_akun" required="required" class="form-control"  value="{{ $a->reff_akun }}" style="width:100%">
                            </div>
                            
                            <div class="form-group" style="width:100%">
                              <label>Nama Akun</label>
                              <input type="text" name="nama_akun" required="required" class="form-control"  value="{{ $a->nama_akun }}" style="width:100%">
                            </div>

                            <div class="form-group" style="width:100%">
                              <label>Keterangan</label>
                              <input type="text" name="keterangan" required="required" class="form-control"  value="{{ $a->keterangan }}" style="width:100%">
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>

                  <!-- modal hapus -->
                  <form method="POST" action="{{ route('akun.delete',['id' => $a->id]) }}">
                    <div class="modal fade" id="hapus_akun_{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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