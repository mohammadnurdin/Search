@extends('app')
@section('content')
  <form action="{{ route('positions.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Name:</strong>
                  <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                  @error('name')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Keterangan:</strong>
                  <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Posisi">
                  @error('keterangan')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Singkatan:</strong>
                        <input type="alias" name="alias" class="form-control" placeholder="Singkatan">
                        @error('alias')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
          <div class="col-lg-12 margin-tb">
            <div class="text-end mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-warning text-end" href="{{ route('departements.index') }}"> Back</a>
            </div>
          </div>
      </div>
  </form>
@endsection