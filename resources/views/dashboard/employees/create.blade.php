@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Add New Employee</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/employees" class="mb-5" enctype="multipart/form-data">
    <!-- multipart form data harus supaya bisa upload file(img dll) -->
    @csrf
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
      <label for="alamat" class="form-label">Alamat</label>
      <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required
        autofocus value="Jalan...">
      @error('alamat')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="jabatan" class="form-label">Jabatan</label>
      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required
        autofocus value="Staff">
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

    <button type="submit" class="btn btn-primary">Add New Employee</button>
  </form>

</div>


@endsection