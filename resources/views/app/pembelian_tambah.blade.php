@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">pembelian</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">pembelian</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <a href="{{ route('pembelian') }}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> &nbsp KEMBALI</a>
        <h4>Tambah pembelian</h4>

      </div>
      <div class="card-body pt-0">

        <div class="row">

          <div class="col-lg-5">

            <form method="POST" action="{{ route('pembelian.aksi') }}" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Tanggal</label>
                  <input id="tanggal" type="date" required placeholder="tanggal" class="form-control" name="tanggal" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Kode Transaksi</label>
                  <input id="kode_transaksi" type="text" placeholder="Kode Transaksi" class="form-control" name="kode_transaksi"  value="{{$nomer}}" readonly>
                </div>
              </div>
              
              <div class="form-group">
                    <label>Supplier</label>
                    <select class="form-control" required="required" name="supplier">
                      <option value="">Pilih</option>
                      @foreach($supplier as $s)
                      <option value="{{ $s->id }}">{{ $s->nama }}</option>
                      @endforeach
                    </select>
                  </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Nominal</label>
                  <input id="kode_transaksi" type="text" placeholder="nominal" class="form-control" name="nominal"  " autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                    <label>Metode</label>
                    <select class="form-control" required="required" name="metode">
                      <option value="">Pilih</option>
                      <option value="Cash">Cash</option>
                      <option value="Bank">Bank</option>
                    </select>
                  </div>

              <div class="form-group">
                <div class="form-group has-feedback">
                  <label class="text-dark">Keterangan</label>
                  <input id="Keterangan" type="text" placeholder="keterangan" class="form-control" name="keterangan"  " autocomplete="off">
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