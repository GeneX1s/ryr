@extends('dashboard.layouts.main')

<style>
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
</style>
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pemantauan Hasil Survei</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
    {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
        action="{{ route('posts.index') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-black">Search</button>
            </div>
        </div>
    </form>


    <table class="table table-striped table-sm">
        <thead class="thead">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Pegawai</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Email</th>
                <th scope="col">Komentar</th>
                <th scope="col">Rating</th>
                <th scope="col">Tanggal</th>
                {{-- <th scope="col">Sangat Tidak Puas</th>
                <th scope="col">Tidak Puas</th>
                <th scope="col">Sedang</th>
                <th scope="col">Puas</th>
                <th scope="col">Sangat Puas</th> --}}
            </tr>
        </thead>
        <tbody>
            @php

            // dd($ratings);
            @endphp
            @foreach ($ratings as $rating)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>{{$rating['employee_name']}}</td>
                <td>{{$rating['nama']}}</td>
                <td>{{$rating['email']}}</td>
                <td>{{$rating['komen']}}</td>
                <td>{{$rating['review']}}</td>
                <td>{{$rating['time']}}</td>
                {{-- <td>{{$rating->employee_name}}</td>
                <td>{{$rating->nama}}</td>
                <td>{{$rating->email}}</td>
                <td>{{$rating->komen}}</td>
                <td>{{$rating->review}}</td> --}}
                {{-- <td>{{$rating->sangat_tidak_puas}}</td>
                <td>{{$rating->tidak_puas}}</td>
                <td>{{$rating->sedang}}</td>
                <td>{{$rating->puas}}</td>
                <td>{{$rating->sangat_puas}}</td> --}}


            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection