@extends('layouts.main')

@section('container')

<style>
  .php-email-form input,
  .php-email-form textarea {
    border-radius: 0;
    box-shadow: none;
    font-size: 14px;
    background: #0c0b09;
    border-color: #625b4b;
    color: white;
  }

  .php-email-form input::-moz-placeholder,
  .php-email-form textarea::-moz-placeholder {
    color: #a49b89;
  }

  .php-email-form input::placeholder,
  .php-email-form textarea::placeholder {
    color: #a49b89;
  }

  .php-email-form input:focus,
  .php-email-form textarea:focus {
    border-color: #cda45e;
  }

  .php-email-form button[type=submit] {
    background: #cda45e;
    border: 0;
    padding: 10px 35px;
    color: #fff;
    transition: 0.4s;
    border-radius: 50px;
  }

  .php-email-form button[type=submit]:hover {
    background: #d3af71;
  }
</style>

<div class="row justify-content-center">
  <div class="col-md-4">
    @if(session()-> has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session('success')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session()-> has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session('loginError')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <br>
    <br>
    <main class="form-signin">
      <h1 class="h3 mb-3 fw-normal">Please log in</h1>
      <form action="/login" class="php-email-form" method="post">
        @csrf
        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
            placeholder="name@example.com" autofocus required value="{{ old ('email') }}">
          <label for="email">Email address</label>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        <br>

        <div class="btns">
          <button class="btn-menu animated fadeInUp scrollto" type="submit">Login</button>
        </div>

        <br>
        {{-- <div class="btns">
          <a href="#menu" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
          <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Book a Table</a>
        </div> --}}
      </form>
      {{-- <small class="d-block text-center mt-3">Not Registered? <a href="/register">Register Now!</a></small> --}}

    </main>

  </div>
</div>
@endsection