@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">penjualan</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">penjualan</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <a href="{{ route('penjualan') }}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> &nbsp KEMBALI</a>
        <h4>Edit penjualan</h4>

      </div>
      <div class="card-body pt-0">

        <div class="row">

          <div class="col-lg-5">

            <form method="POST" action="{{ route('penjualan.update', ['id' => $penjualan->id]) }}" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Tanggal</label>
                  <input id="tanggal" type="date" placeholder="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', $penjualan->tanggal) }}" autocomplete="off">
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
                  <input id="kode_transaksi" type="text"  class="form-control" name="kode_transaksi" value="{{ $penjualan->kode_transaksi }}" autocomplete="off" readonly>               
                </div>
              </div>

              <div class="form-group">
                    <label>Customer</label>
                    <select class="form-control" required="required" name="customer">
                    @foreach($customer as $c)
                    <option {{ ($penjualan->customer_id == $c->id ? "selected='selected'" : "") }}  value="{{ $c->id }}">{{ $c->nama }}</option>
                      @endforeach
                    </select>
                  </div>

               <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Nominal</label>
                  <input id="nominal" type="text"  class="form-control" name="nominal" value="{{ $penjualan->nominal }}" autocomplete="off">               
                </div>
              </div>

              <div class="form-group">
                    <label>Metode</label>
                    <select class="form-control" required="required" name="metode">
                      <option {{ ($penjualan->metode == "bank" ? "selected='selected'" : "") }} value="bank">bank</option>
                    <option {{ ($penjualan->metode == "cash" ? "selected='selected'" : "") }} value="cash">cash</option>
                      </select>
                  </div>

             <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Keterangan</label>
                  <input id="keterangan" type="text"  class="form-control" name="keterangan" value="{{ $penjualan->Keterangan }}" autocomplete="off">               
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