@extends('templates/default')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    {{-- <title>GudangIT - {{ $title }}</title> --}}

    <!-- Icon-->
    <link rel="shortcut icon" href="{{ 'favicon.svg' }}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>
<!-- Page Heading -->
<div class="page-heading d-flex justify-content-between mx-4 mb-2">
    <h1 class="h3 mb-2 text-gray-800">Edit Match</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Match</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{ route('games.update', $game)}}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dynamicTable">  
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="home team">Home Team</label>
                                <select name="home_team_id"  type="text" disabled @disabled($teams) required class="form-control @error('home_team_id') is-invalid @enderror" id="home_team_id" onchange="getSelectValue(this.value)">                
                                <option value="">Pilih Home Team</option>
                                @foreach ($teams as $team)
                                <option @selected($team->id == $game->home_team_id) value="{{$team->id}}">{{$team->nama}}</option>                                         
                                @endforeach
                                </select>
                                @error('home_team_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="away team">Away Team</label>
                                <select name="away_team_id" type="text" disabled  @disabled($teams) required class="form-control @error('away_team_id') is-invalid @enderror" id="away_team_id">                
                                <option  value="">Pilih Away Team</option>
                                @foreach ($teams as $team)
                                <option  @selected($team->id == $game->away_team_id) value="{{$team->id}}">{{$team->nama}}</option>                      
                                @endforeach
                                </select>
                                @error('away_team_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="home_score">Team Home Score</label>
                                <input name="home_score" type="text"
                                    class="form-control @error('home_score') is-invalid @enderror" id="home_score" placeholder="Masukkan asal score team"
                                    value="{{ $game->home_score }}">
                                @error('home_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="away_score">Team Away Score</label>
                                <input name="away_score" type="text"
                                    class="form-control @error('away_score') is-invalid @enderror" id="away_score" placeholder="Masukkan score team"
                                    value="{{ $game->away_score}}">
                                @error('away_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mx-2">
                    <a class="btn btn-info" href="{{route('games.index')}}"> Kembali </a>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function getSelectValue(home_team_id){
        if(home_team_id!=''){
            $("#away_team_id option[value='"+home_team_id+"']").hide();
            $("#away_team_id option[value!='"+home_team_id+"']").show();
        }
    }
</script>
<script src="{{ '/assets/vendor/jquery/jquery.min.js' }}"></script>
<script src="{{ '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js' }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ '/assets/vendor/jquery-easing/jquery.easing.min.js' }}"></script>


<!-- Custom scripts for all pages-->
<script src="{{ '/assets/js/script.js' }}"></script>

<!-- Page level plugins -->
<script src="{{ '/assets/vendor/chart.js/Chart.min.js' }}"></script>

<!-- Page level custom scripts -->
<script src="{{ '/assets/js/demo/chart-area-demo.js' }}"></script>
<script src="{{ '/assets/js/demo/chart-pie-demo.js' }}"></script>

<!-- /.container-fluid -->
@endsection
