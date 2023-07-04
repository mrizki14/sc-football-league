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
    <h1 class="h3 mb-2 text-gray-800">Team</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Team</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{route('team.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Team</label>
                    <input name="nama" type="text"
                        class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama team"
                        value="{{ old('nama') }}">
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kota">Asal Kota Team</label>
                    <input name="kota" type="text"
                        class="form-control @error('kota') is-invalid @enderror" id="kota" placeholder="Masukkan asal kota team"
                        value="{{ old('kota') }}">
                    @error('kota')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mx-2">
                    <a class="btn btn-info" href="{{route('team.index')}}"> Kembali </a>
                    <button class="btn btn-success" type="submit">+ Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
