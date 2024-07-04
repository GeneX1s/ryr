@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Add New Order</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/orders" class="mb-5">
    @csrf
    <div class="col-lg-8">
      <div class="mb-3">
        <label for="menu_id_1" class="form-label">Menu 1</label>
        <select class="form-control" id="menu_id_1" name="menus[1][menu_id]" required>
          <option value="">Select Menu</option>
          @foreach($menus as $menu)
          <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
          @endforeach
        </select>
        <input type="number" class="form-control" id="jumlah_1" name="menus[1][jumlah]" required placeholder="Jumlah">
      </div>
      <div id="menus-container">
        <!-- Ingredient dropdown fields will be added here -->
      </div>
      <button type="button" id="add-menu-btn" class="btn btn-primary">Add Menu</button>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
        required autofocus value="{{old('deskripsi')}}">
      @error('deskripsi')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="customer_name" class="form-label">Nama Pelanggan</label>
      <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name"
        name="customer_name" required autofocus value="{{old('customer_name')}}">
      @error('customer_name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="customer_number" class="form-label">No. HP</label>
      <input type="text" class="form-control @error('customer_number') is-invalid @enderror" id="customer_number" name="customer_number"
        required autofocus value="{{old('customer_number')}}">
      @error('customer_number')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Add Order</button>
  </form>


</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('menus-container');
    const addButton = document.getElementById('add-menu-btn');
    let menuCount = 1;

    addButton.addEventListener('click', function() {
      menuCount++;

      const newIngredientField = `
        <div class="mb-3">
          <label for="menu_id_${menuCount}" class="form-label">Menu ${menuCount}</label>
          <select class="form-control" id="menu_id_${menuCount}" name="menus[${menuCount}][menu_id]" required>
            <option value="">Select Menu</option>
            @foreach($menus as $menu)
              <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
            @endforeach
          </select>
          <input type="number" class="form-control" id="jumlah_${menuCount}" name="menus[${menuCount}][jumlah]" required placeholder="Jumlah">
        </div>
      `;

      container.insertAdjacentHTML('beforeend', newIngredientField);
    });
  });
</script>

@endsection