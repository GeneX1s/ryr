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
  <h1 class="h2">Detail Order</h1>
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
      <th scope="col">ID Transaksi</th>
      <th scope="col">Nama Menu</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Total</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Status</th>
      <th scope="col">Tanggal</th>
    </tr>
  </thead>
  <tbody>
    <div style="display: none;">
      {{$sum = 0;}}
      {{$count = 0;}}
  </div>
    @foreach ($orders as $key => $order)
    <?php $menu = $menus->where('id', $order->id_menu)->first();
      if($order->status == 'Pending' || $order->status == 'Done'){
        $sum = $sum + $order->total;
      }
    if($order->status == 'Pending'){
      $count++;
    }

    ?>
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$order->id_transaksi}}</td>
      <td>{{$menu->nama}}</td>
      {{-- <td>{{$order->id_menu}}</td> --}}
      <td>{{$order->jumlah}}</td>
      <td>Rp.{{ number_format($order->total, '2', ',', '.') }}</td>
      <td>{{$order->deskripsi}}</td>
      <td>{{$order->status}}</td>
      <td>{{$order->created_at}}</td>

    </tr>
    @endforeach

  </tbody>
</table>
<h5>Total Keseluruhan : Rp.{{number_format($sum, '2', ',', '.')}}</h5>
<h5>Status Pesanan : {{$count}} pesanan pending</h5>
<h5>Nama Customer : {{$order->customer_name}}</h5>

</div>
@endsection