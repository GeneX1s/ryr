@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">List Inventori</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('inventories.index') }}" method="GET">
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
          <label for="kategori" class="form-label">Peran</label>
          <input type="text" class="form-control" id="kategori" name="kategori">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <div class="col-md">
        <a href="/dashboard/inventories/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Nilai</th>
        <th scope="col">Satuan</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Kategori</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($inventories as $inventory)
      <tr>
        <td>{{$loop->iteration}}</td>

        <td>{{$inventory->nama}}</td>
        {{-- <td>{{$inventory->nilai}}</td> --}}
        <td>Rp.{{ number_format($inventory->nilai, '2', ',', '.') }}</td>
        <td>/{{$inventory->satuan}}</td>
        <td>{{$inventory->deskripsi}}</td>
        <td>{{$inventory->kategori}}</td>

        <td><a href="/dashboard/inventories/{{$inventory->id}}" class="badge bg-info"><i
              class="fas fa-regular fa-eye"></i> </a>
          <a href="/dashboard/inventories/{{$inventory->id}}/edit" class="badge bg-warning"><i
              class="fas fa-regular fa-pen-nib"></i></a>
          <form action="/dashboard/inventories/{{$inventory->id}}" method="post" class="d-inline">
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