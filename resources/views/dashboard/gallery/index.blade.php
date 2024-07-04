@extends('dashboard.layouts.main')

<style>
  .img {
    width: 70px;
    border-radius: 50%;
    float: left;
    border: 5px solid rgba(255, 255, 255, 0.2);
  }
</style>
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Special Menu</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Judul</th>
        <th scope="col">Header 1</th>
        <th scope="col">Header 2</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Foto(800 x 822)</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($specials as $special)
      <tr>
        <td>{{$loop->iteration}}</td>

        <td>{{$special->title}}</td>
        <td>{{$special->header_1}}</td>
        <td>{{$special->header_2}}</td>
        <td>{{$special->desc}}</td>
        <td>
          <img src={{'../../'.$special->foto}} class="img" alt="{{ $special->title }}">
        </td>

        <td><a href="/dashboard/specials/{{$special->id}}" class="badge bg-info"><i class="fas fa-regular fa-eye"></i> </a>
          <a href="/dashboard/specials/{{$special->id}}/edit" class="badge bg-warning"><i
              class="fas fa-regular fa-pen-nib"></i></a>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection