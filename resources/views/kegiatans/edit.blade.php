@extends('app')
@section('content')
<form action="{{ route('departements.update',$departement->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Departement Name:</strong>
                <input type="text" name="name" value="{{ $departement->name }}" class="form-control" placeholder="Departement name">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Location :</strong>
                <input type="location" name="location" class="form-control" placeholder="location" value="{{ $departement->location }}">
                @error('location')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Manager ID:</strong>
                  <select name="manager_id" class="form-control">
                      @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}" @if($manager->id == $departement->manager_id) selected="selected" @endif>{{$manager->name}}</option>
                      @endforeach
                  </select>
                  @error('manager_id')
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