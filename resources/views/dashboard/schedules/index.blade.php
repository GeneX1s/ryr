@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">List Schedule</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('schedules.index') }}" method="GET">
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
        <a href="/dashboard/schedules/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Title</th>
        <th scope="col">Harga</th>
        <th scope="col">Day</th>
        <th scope="col">Time Group</th>{{-- pagi siang sore malem --}}
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($schedules as $schedule)
      <tr>
        <td>{{$loop->iteration}}</td>

        <td>{{$schedule->title}}</td>
        <td>Rp.{{ number_format($schedule->harga, '2', ',', '.') }}</td>
        <td>{{$schedule->day}}</td>
        <td>{{$schedule->time}}</td>
        <td>{{$schedule->start_time}}</td>
        <td>{{$schedule->end_time}}</td>

        <td><a href="/dashboard/schedules/{{$schedule->id}}" class="badge bg-info"><i
              class="fas fa-regular fa-eye"></i> </a>
          <a href="/dashboard/schedules/{{$schedule->id}}/edit" class="badge bg-warning"><i
              class="fas fa-regular fa-pen-nib"></i></a>
          <form action="/dashboard/schedules/{{$schedule->id}}" method="post" class="d-inline">
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