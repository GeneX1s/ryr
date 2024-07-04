@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">List Pegawai</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('ingredients.index') }}" method="GET">
    @csrf
    <div class="row">
      <div class="col-md-3">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="jabatan" class="form-label">Jabatan</label>
          <input type="text" class="form-control" id="jabatan" name="jabatan">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <div class="col-md">
        <a href="/dashboard/employees/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Jabatan</th>
        <th scope="col">Role</th>
        <th scope="col">Gaji</th>
        <th scope="col">KPI</th>
        <th scope="col">Email</th>
        <th scope="col">NIK</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($employees as $employee)
      <tr>
        <td>{{$loop->iteration}}</td>

        <td>{{$employee->name}}</td>
        <td>{{$employee->alamat}}</td>
        <td>{{$employee->jabatan}}</td>
        <td>{{$employee->role}}</td>
        <td>Rp.{{ number_format($employee->gaji, '2', ',', '.') }}</td>
        <td>{{$employee->kpi}}</td>
        <td>{{$employee->email}}</td>
        <td>{{$employee->nik}}</td>

        <td><a href="/dashboard/employees/{{$employee->id}}" class="badge bg-info"><i
              class="fas fa-regular fa-eye"></i> </a>
          <a href="/dashboard/employees/{{$employee->id}}/edit" class="badge bg-warning"><i
              class="fas fa-regular fa-pen-nib"></i></a>
          <form action="/dashboard/employees/{{$employee->id}}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
              <i class="fas fa-regular fa-trash"></i>
            </button>
          </form>

        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection