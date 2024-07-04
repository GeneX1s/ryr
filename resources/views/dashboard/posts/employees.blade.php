@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Pegawai</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-8">
  <a href="/dashboard/posts/create_user" class="btn btn-primary mb-3">Add New</a>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">NIP</th>
        <th scope="col">Email</th>
        <th scope="col">Sangat Tidak Puas</th>
        <th scope="col">Tidak Puas</th>
        <th scope="col">Sedang</th>
        <th scope="col">Puas</th>
        <th scope="col">Sangat Puas</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      {{-- {{dd($datas);}} --}}
      @foreach ($datas as $data)
      <tr>

        <td>{{$loop->iteration}}</td>
        <td>{{$data['nama']}}</td>
        <td>{{$data['nip']}}</td>
        <td>{{$data['email']}}</td>
        <td>{{$data['sangat_tidak_puas']}}</td>
        <td>{{$data['tidak_puas']}}</td>
        <td>{{$data['sedang']}}</td>
        <td>{{$data['puas']}}</td>
        <td>{{$data['sangat_puas']}}</td>

        <td>

          @if ($data['id'] != auth()->user()->id){{-- jaga biar admin gak self delete --}}

          <form action="/dashboard/posts/employees/{{$data['id']}}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge bg-danger border-0" onclick="return confirm('Deleting user. Are you sure?')">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M8 1a7 7 0 0 0-7 7 7 7 0 0 0 7 7 7 7 0 0 0 7-7 7 7 0 0 0-7-7zm3.354 4.646a.5.5 0 0 1 .708.708L8.707 8l2.354 2.354a.5.5 0 1 1-.708.708L8 8.707l-2.354 2.353a.5.5 0 1 1-.708-.708L7.293 8 4.939 5.646a.5.5 0 0 1 .708-.708L8 7.293l2.354-2.354z" />
              </svg>
            </button>

          </form>

          @endif
        </td>
      </tr>

      @endforeach
    </tbody>
  </table>
</div>

@endsection