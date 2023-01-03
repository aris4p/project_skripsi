@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">pembelian</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">pembelian</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <a href="{{ route('pembelian') }}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> &nbsp KEMBALI</a>
        <h4>Edit pembelian</h4>

      </div>
      <div class="card-body pt-0">

        <div class="row">

          <div class="col-lg-5">

            <form method="POST" action="{{ route('pembelian.update', ['id' => $pembelian->id]) }}" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Tanggal</label>
                  <input id="tanggal" type="date" placeholder="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', $pembelian->tanggal) }}" autocomplete="off">
                  @error('tanggal')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Kode transaksi</label>
                  <input id="kode_transaksi" type="text" readonly class="form-control" name="kode_transaksi" value="{{ $pembelian->kode_transaksi }}" autocomplete="off">               
                </div>
              </div>

              <div class="form-group">
                    <label>Supplier</label>
                    <select class="form-control" required="required" name="supplier">
                    @foreach($supplier as $s)
                    <option {{ ($pembelian->supplier_id == $s->id ? "selected='selected'" : "") }}  value="{{ $s->id }}">{{ $s->nama }}</option>
                      @endforeach
                    </select>
                  </div>

               <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Nominal</label>
                  <input id="nominal" type="text"  class="form-control" name="nominal" value="{{ $pembelian->nominal }}" autocomplete="off">               
                </div>
              </div>

              <div class="form-group">
                    <label>Metode</label>
                    <select class="form-control" required="required" name="metode">
                      <option {{ ($pembelian->metode == "bank" ? "selected='selected'" : "") }} value="bank">bank</option>
                    <option {{ ($pembelian->metode == "cash" ? "selected='selected'" : "") }} value="cash">cash</option>
                      </select>
                  </div>

             <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Keterangan</label>
                  <input id="keterangan" type="text"  class="form-control" name="keterangan" value="{{ $pembelian->Keterangan }}" autocomplete="off">               
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