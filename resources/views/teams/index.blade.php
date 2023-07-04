@extends('templates/default')
@section('content')
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Team</h1>
</div>
@if (session('success'))
<div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="font-weight-bold text-primary mt-2 ml-2">Data Team</h6>
        <div class="d-flex">
            

              <div>
                <a class="btn btn-success" href="{{route('team.create')}}">+ Tambah</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kota</th>
                        <th>Aksi</th>                  
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($teams as $team)
                    <tr>
                        <td class="number">{{ $no++ }}.</td>
                        <td class="text-uppercase">{{ $team->nama }}</td>
                        <td class="text-uppercase">{{ $team->kota }}</td>
                        <td>
                            <div>
                                <a href="{{ route('team.edit', $team)}}" class="btn btn-primary">Edit</a>
                                <form class="d-inline" action="{{ route('team.destroy', $team)}}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apa kamu yakin?')" >Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
