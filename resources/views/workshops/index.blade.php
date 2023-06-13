@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success  alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" 
  aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
<a class="btn btn-light" href="{{ route('workshops.exportPdf') }}"> Export</a>
<a class="btn btn-secondary" href="{{ route('workshops.create') }}"> Add Departement</a>
</div>
<table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Manager Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($workshops as $data)
    <tr>
        <td>{{ $workshops->id }}</td>
        <td>{{ $workshops->name }}</td>
        <td>{{ $workshops->location }}</td>
        <td>{{ 
          (isset($workshops->getManager->email)) ? 
          $workshops->getManager->email : 
          'Tidak Ada'
          }}
        </td>
        <td>
            <form action="{{ route('workshops.destroy',$data->id) }}" method="Post">
                <a class="btn btn-primary" href="{{ route('workshops.edit',$data->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
@section('js')
<script>
  $(document).ready(function () {
      $('#example').DataTable();
  });
</script>
@endsection