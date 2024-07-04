@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Menu</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/ingredients/{{$ingredient->id}}" class="mb-5" enctype="multipart/form-data">
    @method('put')
    @csrf
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
      <label for="nilai" class="form-label">Nilai</label>
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
        required autofocus value="Sayur">
      @error('kategori')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Ingredient</button>
  </form>

</div>

@endsection