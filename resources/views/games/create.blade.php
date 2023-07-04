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
    <h1 class="h3 mb-2 text-gray-800">Match</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Match</h6>
    </div>
    <div class="card-body" id="dynamicAddRemove">
        <div class="table-responsive" >
            <form action="{{route('games.store')}}" method="POST">
                @csrf

                <table class="table table-bordered" id="dynamicTable">  
                    <tr>  
                        <td>
                            <div class="form-group" > 
                                <label for="home team">Home Team</label>
                                <select name="addMore[0][home_team_id]" id="home_team_id" required class="form-control @error('addMore.*.home_team_id') is-invalid @enderror" onchange="getSelectValue(this.value)">                
                                <option value="">Pilih Home Team</option>
                                @foreach ($teams as $team)
                                <option value="{{$team->id}}"  @selected(old('home_team_id') == $team->id)>{{$team->nama}}</option>                      
                                @endforeach
                                </select> 
                                @error('addMore.*.home_team_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="away team">Away Team</label>
                                <select name="addMore[0][away_team_id]" required class="form-control @error('addMore.*.away_team_id') is-invalid @enderror" id="away_team_id">                
                                <option value="">Pilih Away Team</option>
                                @foreach ($teams as $team)
                                <option value="{{$team->id}}" @selected(old('addMore.*.away_team_id') == $team->id)>{{$team->nama}}</option>                      
                                @endforeach
                                </select>
                                @error('addMore.*.away_team_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </td> 
                    
                            <td>
                                <div class="form-group">
                                    <label for="home_score">Team Home Score</label>
                                    <input name="addMore[0][home_score]" type="number"
                                        class="form-control @error('home_score') is-invalid @enderror" id="home_score" placeholder="Masukkan score team"
                                        value="{{ old('home_score') }}">
                                    @error('home_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="away_score">Team Away Score</label>
                                    <input name="addMore[0][away_score]" type="number"
                                        class="form-control @error('away_score') is-invalid @enderror" id="away_score" placeholder="Masukkan score team"
                                        value="{{ old('away_score') }}">
                                    @error('away_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </td>
                       
                    </tr>  
                </table> 
                
                
                
              

                <div class="d-flex justify-content-between mx-2">
                    <a class="btn btn-info" href="{{route('team.index')}}"> Kembali </a>
                    <button class="btn btn-success" type="submit">+ Tambah</button>
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
    };

    var i = 0;
       
       $("#add").click(function(){   
           ++i;
         $("#dynamicTable").append('<tr><td><div class="form-group" > <label for="home team">Home Team</label><select name="addMore['+i+'][home_team_id]" id="home_team_id" required class="form-control @error('home_team_id') is-invalid @enderror" onchange="getSelectValue(this.value)"><option value="">Pilih Home Team</option>@foreach ($teams as $team)<option value="{{$team->id}}"  @selected(old('home_team_id') == $team->id)>{{$team->nama}}</option>@endforeach</select> @error('home_team_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></td><td><div class="form-group"><label for="away team">Away Team</label><select name="addMore['+i+'][away_team_id]" required class="form-control @error('away_team_id') is-invalid @enderror" id="away_team_id"><option value="">Pilih Away Team</option>@foreach ($teams as $team)<option value="{{$team->id}}" @selected(old('away_team_id') == $team->id)>{{$team->nama}}</option>@endforeach</select>@error('away_team_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></td><td><div class="form-group"><label for="home_score">Team Home Score</label><input name="addMore['+i+'][home_score]" type="text"class="form-control @error('home_score') is-invalid @enderror" id="home_score" placeholder="Masukkan score team"value="{{ old('home_score') }}">@error('home_score')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></td><td><div class="form-group"><label for="away_score">Team Away Score</label><input name="addMore['+i+'][away_score]" type="text"class="form-control @error('away_score') is-invalid @enderror" id="away_score" placeholder="Masukkan score team" value="{{ old('away_score') }}">@error('away_score')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
       });
      
       $(document).on('click', '.remove-tr', function(){  
            $(this).closest('tr').remove();
       });  
</script>
<!-- /.container-fluid -->
@endsection
