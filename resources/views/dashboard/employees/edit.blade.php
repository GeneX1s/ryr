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
      <label for="alamat" class="form-label">Alamat</label>
      <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required
        autofocus value="gram">
      @error('alamat')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="jabatan" class="form-label">Jabatan</label>
      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required
        autofocus value="gram">
      @error('jabatan')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
        required autofocus value="{{old('role')}}">
      @error('role')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="gaji" class="form-label">Gaji(Rp.)</label>
      <input type="number" class="form-control @error('gaji') is-invalid @enderror" id="gaji" name="gaji" required
      autofocus value="{{old('gaji')}}">
      @error('gaji')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    


    <div class="mb-3">
      <label for="kpi" class="form-label">KPI</label>
      <input type="text" class="form-control @error('kpi') is-invalid @enderror" id="kpi" name="kpi"
        required autofocus value="{{old('kpi')}}">
      @error('kpi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        required autofocus value="{{old('email')}}">
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nik" class="form-label">NIK</label>
      <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
        required autofocus value="{{old('nik')}}">
      @error('nik')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Employee</button>
  </form>

</div>


@endsection