@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">Supplier</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Supplier</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-plus"></i> &nbsp TAMBAH Supplier
        </button>
        <h4>Data Supplier</h4>

      </div>
      <div class="card-body pt-0">

        <!-- Modal -->
        <form action="{{ route('supplier.aksi') }}" method="post">
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  @csrf
                  <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Supplier ..">
                  </div>
                  <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" name="notelpon" required="required" class="form-control" placeholder="No Telepon ..">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" required="required" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label>Jenis</label>
                    <select class="form-control" required="required" name="jenis">
                      <option value="">Pilih</option>
                      <option value="Reguler">Reguler</option>
                      <option value="Priority">Priority</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>alamat</label>
                    <input type="text" name="alamat" required="required" class="form-control" placeholder="alamat">
                  </div>
                  <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota" required="required" class="form-control" placeholder="Kota">
                  </div>
               <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" required="required" name="status">
                      <option value="">Pilih</option>
                      <option value="Aktif">Aktif</option>
                      <option value="Nonaktif">Tidak Aktif</option>
                    </select>
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
                <th>Nama Supplier</th>
                <th>No telepon</th>
                <th>Email</th>
                <th>Jenis</th>
                <th>alamat</th>
                <th>Kota</th>
                <th>Status</th>

                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($supplier as $s)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->no_telepon }}</td>
                <td>{{ $s->Email }}</td>
                <td>{{ $s->jenis }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->kota }}</td>
                <td>{{ $s->status }}</td>
                <td>    

                  @if($s->id != 0)
                  <div class="text-center">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit_supplier_{{ $s->id }}">
                      <i class="fa fa-cog"></i>
                    </button>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_supplier_{{ $s->id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  @endif

                  <form action="{{ route('supplier.update',['id' => $s->id]) }}" method="post">
                    <div class="modal fade" id="edit_supplier_{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group" style="width:100%">
                              <label>Nama Supplier</label>
                              <input type="hidden" name="id" value="{{ $s->id }}">
                              <input type="text" name="nama" required="required" class="form-control"  value="{{ $s->nama }}" style="width:100%">
                            </div>
                            <div class="form-group" style="width:100%">
                              <label>No telepon</label>
                              <input type="text" name="notelpon" required="required" class="form-control"  value="{{ $s->no_telepon }}" style="width:100%">
                            </div>
                            <div class="form-group" style="width:100%">
                              <label>Email</label>
                              <input type="text" name="email" required="required" class="form-control"  value="{{ $s->Email }}" style="width:100%">
                            </div>
                            <div class="form-group" style="width: 100%;margin-bottom:20px">
                              <label>Jenis</label>
                              <select class="form-control py-0" required="required" name="jenis" style="width: 100%">
                                <option value="">Pilih</option>
                                <option {{ ($s->jenis == "Reguler" ? "selected='selected'" : "") }} value="Reguler">Reguler</option>
                                <option {{ ($s->jenis == "Priority" ? "selected='selected'" : "") }} value="Priority">Priority</option>
                              </select>
                            </div>
                            <div class="form-group" style="width:100%">
                              <label>alamat</label>
                              <input type="text" name="alamat" required="required" class="form-control"  value="{{ $s->alamat }}" style="width:100%">
                            </div>
                            <div class="form-group" style="width:100%">
                              <label>Kota</label>
                              <input type="text" name="kota" required="required" class="form-control"  value="{{ $s->kota }}" style="width:100%">
                            </div>
                            <div class="form-group" style="width: 100%;margin-bottom:20px">
                              <label>Status</label>
                              <select class="form-control py-0" required="required" name="status" style="width: 100%">
                                <option value="">Pilih</option>
                                <option {{ ($s->status == "Aktif" ? "selected='selected'" : "") }} value="Aktif">Aktif</option>
                                <option {{ ($s->status == "Nonaktif" ? "selected='selected'" : "") }} value="Nonaktif">Nonaktif</option>
                              </select>
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
                  <form method="POST" action="{{ route('supplier.delete',['id' => $s->id]) }}">
                    <div class="modal fade" id="hapus_supplier_{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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