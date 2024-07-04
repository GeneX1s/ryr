@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Special</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/specials/{{$special->id}}" class="mb-5" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Judul</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required
        autofocus value="{{old('title',$special->title)}}">
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="header_1" class="form-label">Header 1</label>
      <input type="text" class="form-control @error('header_1') is-invalid @enderror" id="header_1" name="header_1" required
        autofocus value="{{old('header_1',$special->header_1)}}">
      @error('header_1')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="header_2" class="form-label">Header 2</label>
      <input type="text" class="form-control @error('header_2') is-invalid @enderror" id="header_2" name="header_2"
        required autofocus value="{{old('header_2',$special->header_2)}}">
      @error('header_2')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="desc" class="form-label">Deskripsi</label>
      <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
        name="desc" required autofocus value="{{old('desc',$special->desc)}}">
      @error('desc')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="foto" class="form-label">Foto</label>
      <img class="img-preview img-fluid mb-3 col-sm-5">
      <input type="hidden" name="oldImage" value="{{$special->foto}}">
      @if($special->foto)
      <img src="{{ asset('storage/' . $special->foto)}}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
      @else
      <img class="img-preview img-fluid mb-3 col-sm-5">
      @endif

      <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto"
        onchange="previewImage()">
      @error('foto')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror

    </div>
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