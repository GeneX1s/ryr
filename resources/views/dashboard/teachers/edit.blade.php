@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Teacher</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/teachers/{{$teacher->id}}" class="mb-5" enctype="multipart/form-data">
    <!-- multipart form data harus supaya bisa upload file(img dll) -->
    @csrf
    @method('put')

    <div class="mb-3">
      <label for="name" class="form-label">Nama</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required
        autofocus value="{{old('name')}}">
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="instagram" class="form-label">Instagram</label>
      <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" instagram="instagram" required
        autofocus value="{{old('instagram')}}">
      @error('instagram')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="telp" class="form-label">No. HP</label>
      <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp"
        required autofocus value="18.30">
      @error('telp')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="usia" class="form-label">Usia</label>
      <input type="text" class="form-control @error('usia') is-invalid @enderror" id="usia" name="usia"
        required autofocus value="20.00">
      @error('usia')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="kelas" class="form-label">Tipe Kelas</label>
      <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas"
        required autofocus value="20.00">
      @error('kelas')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Teacher</button>
  </form>

</div>


@endsection