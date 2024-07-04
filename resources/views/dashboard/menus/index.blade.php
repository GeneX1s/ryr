@extends('dashboard.layouts.main')

{{-- <style>
  .table {
    border-collapse: separate;
    /* Separate borders for table cells */
    border-spacing: 0;
    /* Remove default spacing between cells */
  }

  .table td {
    padding: 12px;
    /* Increase padding */
    border-right: 1px solid #dee2e6;
  }

  .table thead th {
    vertical-align: middle;
    padding: 20px;
    border-right: 1px solid #dee2e6;
    /* Center header text vertically */
  }

  .table tbody td {
    vertical-align: middle;
    padding: 15px;
    /* Center cell text vertically */
  }

  .table thead th:last-child,
  .table tbody td:last-child {
    border-right: none;
    /* Remove border for the last column */
  }

  .thead {
    background: rgb(204, 203, 203);
  }
</style> --}}

<style>
  .img {
    width: 100px;
    border-radius: 50%;
    float: center;
    border: 2px solid rgba(255, 255, 255, 0.2);
  }
</style>
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">List Menu</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('menus.index') }}" method="GET">
    @csrf
    <div class="row">
      <div class="col-md-3">
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="kategori_1" class="form-label">Kategori</label>
          <input type="text" class="form-control" id="kategori_1" name="kategori_1">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <div class="col-md">
        <a href="/dashboard/menus/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Nilai</th>
        <th scope="col">Harga</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Kategori</th>
        <th scope="col">Tipe</th>
        <th scope="col">Foto(400 x 400)</th>
        <th scope="col">Ingredient</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($menus as $menu)
      <tr>
        <td>{{$loop->iteration}}</td>


        <td>{{$menu['nama']}}</td>
        {{-- <td>{{$menu['nilai']}}</td> --}}
        <td>Rp.{{ number_format($menu['nilai'], '2', ',', '.') }}</td>
        <td>Rp.{{ number_format($menu['harga'], '2', ',', '.') }}</td>
        {{-- <td>{{$menu['harga']}}</td> --}}
        <td>{{$menu['deskripsi']}}</td>
        <td>{{$menu['kategori_1']}}</td>
        <td>{{$menu['kategori_2']}}</td>
        <td>
          <img src="{{ '../../'.$menu['foto'] }}" class="img" alt="{{ $menu['nama'] }}">
        </td>
        {{-- <td>{{$menu->nama}}</td>
        <td>{{$menu->nama}}</td>
        <td>{{$menu->nama}}</td>
        <td>{{$menu->harga}}</td>
        <td>{{$menu->deskripsi}}</td>
        <td>{{$menu->kategori_1}}</td>
        <td>{{$menu->kategori_2}}</td> --}}
        {{-- <td>
          <img src={{'../../'.$menu->foto}} class="img" alt="{{ $menu->nama }}">
        </td> --}}

        <td><a href="/dashboard/menus/{{$menu['id']}}" class="badge bg-success"><i class="fas fa-regular fa-plus"></i>
          </a>
          <a href="/dashboard/ingredientmenus/{{$menu['id']}}/show" class="badge bg-info"><i
              class="fas fa-regular fa-eye"></i>
          </a>
        </td>
        {{-- <a href="/dashboard/menus/{{$menu->id}}/edit" class="badge bg-warning"><i --}} <td>
            <a href="/dashboard/menus/{{$menu['id']}}/edit" class="badge bg-warning"><i
                class="fas fa-regular fa-pen-nib"></i></a>
            <form action="/dashboard/menus/{{$menu['id']}}" method="post" class="d-inline">
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