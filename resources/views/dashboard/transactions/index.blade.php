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
  <h1 class="h2">Transactions</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('transactions.index') }}" method="GET">
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
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="kategori_1" class="form-label">Jenis</label>
          <input type="text" class="form-control" id="kategori_1" name="kategori_1">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <div class="col-md">
        <a href="/dashboard/transactions/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Jenis</th>
        <th scope="col">Tipe</th>
        <th scope="col">Nominal</th>
        <th scope="col">Biaya Tambahan</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Status</th>
        <th scope="col">Author</th>
        <th scope="col">Edited By</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transactions as $transaction)
      <tr>
        <td>{{$loop->iteration}}</td>

        <td>{{$transaction->nama}}</td>
        <td>{{$transaction->created_at}}</td>
        <td>{{$transaction->jenis}}</td>
        <td>{{$transaction->tipe}}</td>
        <td>Rp.{{ number_format($transaction->nominal, '2', ',', '.') }}</td>
        <td>Rp.{{ number_format($transaction->biaya_tambahan, '2', ',', '.') }}</td>
        <td>{{$transaction->deskripsi}}</td>
        <td>{{$transaction->status}}</td>
        <td>{{$transaction->_author}}</td>
        <td>{{$transaction->_author}}</td>

        <td>
          <form action="/dashboard/transactions/{{$transaction->id}}" method="post" class="d-inline">
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

  <div class="row">
    <div class="col-md-3">
      <div class="mb-3">
        <h6>Total : Rp.{{ number_format($total, '2', ',', '.') }}</h6>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <h6>Pendapatan(+) : Rp.{{ number_format($pendapatan, '2', ',', '.') }}</h6>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <h6>Pengeluaran(-) : Rp.{{ number_format($pengeluaran, '2', ',', '.') }}</h6>
      </div>
    </div>
  </div>

</div>
@endsection