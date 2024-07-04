@extends('dashboard.layouts.main')

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
  <h1 class="h2">Ingredients for "{{ $menu->nama }}"</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">

  <div class="col-md">
    <a href="/dashboard/menus/{{$menu['id']}}" class="btn btn-primary mb-3">Add New</a>
  </div>
</div>

@if (empty($resep))
<div class="alert alert-warning col-lg-8" role="alert">
  No ingredients found.
</div>
@else
<table class="table table-striped table-sm">
  <thead class="thead">
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Nama Bahan</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($resep as $key =>$recipe)
    <tr>
      <td>{{$loop->iteration}}</td>


      <td>{{$resep[$key]['Bahan']}}</td>
      <td>{{$resep[$key]['Jumlah']}}</td>

      <td>
        <form action="/dashboard/ingredientmenus/{{$resep[$key]['Id']}}/delete" method="post" class="d-inline">
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
@endif
@endsection