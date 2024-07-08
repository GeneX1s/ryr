@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Add New Schedule</h1>
</div>
<div class="col-lg-8">
  <form method="post" action="/dashboard/schedules" class="mb-5" enctype="multipart/form-data">
    <!-- multipart form data harus supaya bisa upload file(img dll) -->
    @csrf


    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required
        autofocus value="{{old('title')}}">
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Harga(Rp.)</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required
        autofocus value="{{old('harga')}}">
      @error('harga')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="day" class="form-label">Day</label>
      <select class="form-control" name="day">
        <option value="Senin" selected> Senin</option>
        <option value="Selasa"> Selasa</option>
        <option value="Rabu"> Rabu</option>
        <option value="Kamis"> Kamis</option>
        <option value="Jumat"> Jumat</option>
        <option value="Sabtu"> Sabtu</option>
        <option value="Minggu"> Minggu</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="time" class="form-label">Time</label>
      <select class="form-control" name="time">
        <option value="pagi" selected> 06.00 - 10.00</option>
        <option value="siang"> 10.01 - 17.00</option>
        <option value="sore"> 17.01 - 21.00</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="start_time" class="form-label">Start Time</label>
      <input type="text" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time"
        required autofocus value="18.30">
      @error('start_time')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="end_time" class="form-label">End Time</label>
      <input type="text" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time"
        required autofocus value="20.00">
      @error('end_time')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Add Schedule</button>
  </form>

</div>


@endsection