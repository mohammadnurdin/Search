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
<a class="btn btn-warning" href="{{ route('workshops.chartLine') }}"> Chart</a>
<a class="btn btn-secondary" href="{{ route('workshops.create') }}"> Add Workshop</a>
</div>
<table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode Workshop</th>
      <th scope="col">Bulan Kegiatan</th>
      <th scope="col">Ketua</th>
      <th scope="col">Nama Workshop</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @php $no = 1 @endphp
    @foreach ($workshops as $data)
    <tr>
        <td>{{ $no ++ }}</td>
        <td>{{ $data->id_workshop }}</td>
        <td>{{ $data->bulan }}</td>
        <td>{{ 
          (isset($data->getManager->name)) ? 
          $data->getManager->name : 
          'Tidak Ada'
          }}
        <td>{{ $data->nama_workshop }}</td>
        <td>{{ $data->detail->count() }}</td>
      
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