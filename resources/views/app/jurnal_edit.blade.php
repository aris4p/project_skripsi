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

          <form method="POST" action="{{route('jurnal.update', ['id' => $jurnal->id])}}" enctype="multipart/form-data">
               
              @csrf
              {{ method_field('PUT') }}

              <div class="form-group">
                <div class="form-group has-feedback">
                  <input id="tanggal" type="date" placeholder="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', $jurnal->tanggal) }}" autocomplete="off">
                  @error('tanggal')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                    <label>Akun</label>
                    <select class="form-control" required="required" name="kode_id">
                      @foreach($akun as $a)
                      <option {{ ($jurnal->kode_id == $a->id ? "selected='selected'" : "") }}  value="{{ $a->id }}">{{ $a->nama_akun }}</option>
                      @endforeach
                    </select>
                  </div>
              
              <div class="form-group">
                    <label>Jenis</label>
                    <select class="form-control" required="required" name="jenis">
                    
                      <option {{ ($jurnal->jenis == "debit" ? "selected='selected'" : "") }} value="debit">Debit</option>
                      <option {{ ($jurnal->jenis == "kredit" ? "selected='selected'" : "") }} value="kredit">kredit</option>
                    </select>
                  
                  </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Nominal</label>
                  <input id="nominal" type="text" placeholder="nominal" class="form-control" name="nominal" value="{{ old('nominal', $jurnal->nominal) }}" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Keterangan</label>
                  <input id="keterangan" type="text" placeholder="keterangan" class="form-control" name="keterangan" value="{{ old('nominal', $jurnal->keterangan) }}" autocomplete="off">
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

