<!-- navbar -->
<nav class="navbar navbar-dark bg-primary mb-4">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">LAKEMA</span>
      </div>
    </nav>
    <!-- akhir navbar -->

@extends('layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <form action="{{ route('login.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>email <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required/>
            </div>
            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" required/>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Login</button>
            </div>
            <div>
            <p>Anda belum memiliki akun ? <a href="{{ route('register') }}">Register</a> Sekarang !</p>
            </div>
        </form>
    </div>
</div>

<!-- content -->


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

@endsection