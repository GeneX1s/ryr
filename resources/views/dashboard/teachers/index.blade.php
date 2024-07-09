@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">List Teacher</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('teachers.index') }}" method="GET">
    @csrf
    <div class="row">
      <div class="col-md-3">
        <div class="mb-3">
          <label for="title" class="form-label">Nama Kelas</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="harga" class="form-label">Day</label>
          <input type="text" class="form-control" id="harga" name="harga">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <div class="col-md">
        <a href="/dashboard/teachers/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Instagram</th>
        <th scope="col">No. HP</th>
        <th scope="col">Usia</th>{{-- pagi siang sore malem --}}
        <th scope="col">Tipe Kelas</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($teachers as $teacher)
      <tr>
        <td>{{$loop->iteration}}</td>

        <td>{{$teacher->name}}</td>
        <td>{{$teacher->instagram}}</td>
        <td>{{$teacher->telp}}</td>
        <td>{{$teacher->usia}}</td>
        <td>{{$teacher->kelas}}</td>

        <td><a href="/dashboard/teachers/{{$teacher->id}}" class="badge bg-info"><i
              class="fas fa-regular fa-eye"></i> </a>
          <a href="/dashboard/teachers/{{$teacher->id}}/edit" class="badge bg-warning"><i
              class="fas fa-regular fa-pen-nib"></i></a>
          <form action="/dashboard/teachers/{{$teacher->id}}" method="post" class="d-inline">
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