@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Create New Menu</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/menus" class="mb-5" enctype="multipart/form-data">
    <!-- multipart form data harus supaya bisa upload file(img dll) -->
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
      <label for="harga" class="form-label">Harga</label>
      <input type="text" step = "0.01" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required
        autofocus value="{{old('harga')}}">
      @error('harga')
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
      <label for="kategori_1" class="form-label">Kategori</label>
      <input type="text" class="form-control @error('kategori_1') is-invalid @enderror" id="kategori_1" name="kategori_1"
        required autofocus value="{{old('kategori_1')}}">
      @error('kategori_1')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="kategori_2" class="form-label">Tipe</label>
      <input type="text" class="form-control @error('kategori_2') is-invalid @enderror" id="kategori_2" name="kategori_2" required
        autofocus value="{{old('kategori_2')}}">
      @error('kategori_2')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="foto" class="form-label">Foto Makanan</label>
      <img class="img-preview img-fluid mb-3 col-sm-5">
      <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto"
        onchange="previewImage()">
      @error('foto')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror

    </div>
    {{-- <form action="{{ route('menus.uploadImage') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="foto" class="form-label">Foto Makanan</label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto"
          onchange="previewImage()">
        @error('foto')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div> --}}



      <button type="submit" class="btn btn-primary">Add Menu</button>
    </form>

</div>

<script>
  function previewImage(){
  const image = document.querySelector('#foto');
  const imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    imgPreview.src = oFREvent.target.result;
  }
  }
</script>

@endsection