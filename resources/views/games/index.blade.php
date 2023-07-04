@extends('templates/default')
@section('content')
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Match</h1>
</div>
@if (session('success'))
<div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="font-weight-bold text-primary mt-2 ml-2">Data Match</h6>
        <div class="d-flex">
            

              <div>
                <a class="btn btn-success" href="{{route('games.create')}}">+ Tambah</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Score</th>
                        <th>Aksi</th>                  
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1 + (($games->currentPage() -1 ) * $games->perPage());
                    @endphp
                    @foreach ($games as $game)
                    <tr>
                        <td class="number">{{ $no++ }}.</td>
                        <td class="text-uppercase">{{ $game->homeTeam->nama }}</td>
                        <td class="text-uppercase">{{ $game->awayTeam->nama }}</td>
                        <td class="text-uppercase">{{ $game->home_score }} - {{ $game->away_score }}</td>
                        {{-- <td class="text-uppercase">{{ $game->kota }}</td> --}}
                        <td>
                           <div>
                                <a href="{{ route('games.edit', $game)}}" class="btn btn-primary">Edit</a>
                                <form class="d-inline" action="{{ route('games.destroy', $game->id)}}" method="POST" >
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
            {{ $games->links() }}
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
