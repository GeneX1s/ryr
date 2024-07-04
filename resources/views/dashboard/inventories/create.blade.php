@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Add New Inventory</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/inventories" class="mb-5" enctype="multipart/form-data">
    <!-- multipart form data harus supaya bisa upload file(img dll) -->
    @csrf

    <div class="mb-3">
      <label for="id_grup" class="form-label">ID Grup</label>
      <input type="text" class="form-control @error('id_grup') is-invalid @enderror" id="id_grup" name="id_grup" required
        readonly value="{{md5(Str::random(10))}}">
      @error('id_grup')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required
        autofocus value="{{old('nama')}}">
      @error('nama')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="jumlah" class="form-label">Jumlah</label>
      <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" required
        autofocus value="{{old('jumlah')}}">
      @error('jumlah')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nilai" class="form-label">Nilai(Rp.)</label>
      <input type="number" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" required
        autofocus value="{{old('nilai')}}">
      @error('nilai')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="satuan" class="form-label">Satuan</label>
      <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required
        autofocus value="gram">
      @error('satuan')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="jenis" class="form-label">Jenis</label>
      <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required
        autofocus value="Alat Masak">
      @error('jenis')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
        required autofocus value="{{old('deskripsi')}}">
      @error('deskripsi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori"
        required autofocus value="Alat">
      @error('kategori')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Add Inventory</button>
  </form>

</div>


@endsection