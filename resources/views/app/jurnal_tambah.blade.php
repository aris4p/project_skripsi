@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">Jurnal</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Jurnal</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <a href="{{ route('jurnal') }}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> &nbsp KEMBALI</a>
        <h4>Tambah Jurnal</h4>

      </div>
      <div class="card-body pt-0">

        <div class="row">

          <div class="col-lg-5">

          <form method="POST" action="{{route('jurnal.aksi')}}" enctype="multipart/form-data">
               
              @csrf

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Tanggal</label>
                  <input id="tanggal" type="date" required placeholder="tanggal" class="form-control" name="tanggal" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                    <label>Akun</label>
                    <select class="form-control" required="required" name="kode_akun">
                      <option value="">Pilih</option>
                      @foreach($akun as $a)
                      <option value="{{ $a->id }}">{{ $a->nama_akun }}</option>
                      @endforeach
                    </select>
                  </div>
              
              <div class="form-group">
                    <label>Jenis</label>
                    <select class="form-control" required="required" name="jenis">
                      <option value="">Pilih</option>
                      <option value="debit">Debit</option>
                      <option value="kredit">Kredit</option>
                    </select>
                  </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Nominal</label>
                  <input id="nominal" type="text"  class="form-control" name="nominal" >
                </div>
              </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Keterangan</label>
                  <input id="keterangan" type="text"  class="form-control" name="keterangan" >
                </div>
              </div>

              
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>


        </div>

      </div>

    </div>

  </div>
  <!-- #/ container -->
</div>

@endsection

