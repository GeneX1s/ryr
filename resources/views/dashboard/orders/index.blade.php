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
  <h1 class="h2">Orders</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-3" role="alert">
  {{ session('success') }}
</div>
@endif

@if (session('warning'))
    <div class="alert alert-warning col-lg-4" role="alert">
        {{ session('warning') }}
    </div>
@endif


<div class="table-responsive col-lg-10">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Insert New Product</a> --}}<form
    action="{{ route('orders.index') }}" method="GET">
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
          <label for="id_transaksi" class="form-label">ID Transaksi</label>
          <input type="text" class="form-control" id="id_transaksi" name="id_transaksi">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="status_transaksi" class="form-label">Status Transaksi</label>
          <select class="form-control" name="status_transaksi" id="status_transaksi">
            <option value="Pending"{{ old('status_transaksi') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Done"{{ old('status_transaksi') == 'Done' ? 'selected' : '' }}>Done</option>
            <option value="Cancelled"{{ old('status_transaksi') == 'Cancel' ? 'selected' : '' }}>Cancel</option>
          </select>
        </div>
      </div>
      
      
      {{-- <div class="col-md-3">
        <div class="mb-3">
          <label for="id_menu" class="form-label">ID Menu</label>
          <input type="text" class="form-control" id="id_menu" name="id_menu">
        </div>
      </div> --}}
    </div>
    <div class="row">
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <div class="col-md">
        <a href="/dashboard/orders/create" class="btn btn-primary mb-3">Add New</a>
      </div>
    </div>
  </form>


  <table class="table table-striped table-sm">
    <thead class="thead">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">ID Transaksi</th>
        {{-- <th scope="col">ID Menu</th> --}}
        {{-- <th scope="col">Jumlah</th> --}}
        <th scope="col">Total</th>
        <th scope="col">Nama Pesanan</th>
        <th scope="col">Status</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Nama Pelanggan</th>
        <th scope="col">No. Table</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td>{{$loop->iteration}}</td>
        <?php 
        // dd($menus);
        if($menus!=[]){
          $menu = $menus->where('id', $order->id_menu)->first();  
          $nama_menu = $menu->nama;
        }else{
          $nama_menu = "-";
        }?>
        <td>{{$order->id_transaksi}}</td>
        {{-- <td>{{$order->id_menu}}</td> --}}
        {{-- <td>{{$order->jumlah}}</td> --}}
        <td>Rp.{{ number_format($order->total, '2', ',', '.') }}</td>
        <td>{{$nama_menu}}</td>
        {{-- <td>{{$order->deskripsi}}</td> --}}
        <td>{{$order->status}}</td>
        <td>{{$order->created_at}}</td>
        <td>{{$order->customer_name}}</td>
        {{-- <td>{{$order->customer_number}}</td> --}}

        <td>
          <form action="/dashboard/orders/changeStatus/{{$order->id}}" method="post" class="d-inline">
            @csrf
            @method('POST')
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-control" name="status">
                <option value="Pending" disabled{{$order->status == "Pending" ? 'selected' : ''}}> Pending</option>
                <option value="Done" {{$order->status == "Done" ? 'selected' : ''}}> Done</option>
                <option value="Cancelled" {{$order->status == "Cancelled" ? 'selected' : ''}}> Cancel</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" >Change Status</button>
            {{-- <br>
            <br> --}}
          </form>
          <form action="/dashboard/orders/{{$order->id}}" method="get" class="d-inline">
            <button type="submit" class="btn btn-primary">Detail</button>
        </form>

          </form>

        </td>

      </tr>
      @endforeach

    </tbody>
  </table>

  <h5>Menu paling populer : </h5>
  <h5>Laba per menu(done) : <td>Rp.{{ number_format($income, '2', ',', '.') }}</td></h5>


    
    
    
</div>
@endsection