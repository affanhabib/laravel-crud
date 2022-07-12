@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <h3 class="title">Tambah Artikel</h3>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Maaf</strong> Data yang anda inputkan bermasalah.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('daftar-artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="header" class="col-md-6 col-form-label text-md-right">Foto Header</label>
                    <div class="col-md-6">
                        <input id="header" type="file" class="rounded form-control @error('header') is-invalid @enderror" name="header" autofocus accept="image/jpeg, image/png">
                        @error('header')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="judul" class="col-md-6 col-form-label text-md-right">Judul Artikel</label>
                    <div class="col-md-6">
                        <input id="judul" type="text" class="rounded form-control @error('judul') is-invalid @enderror" name="judul" required autofocus>
                        @error('judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="artikel" class="col-md-6 col-form-label text-md-right">Artikel</label>
                    <div class="col-md-6">
                        <textarea id="artikel" type="text" class="rounded form-control @error('artikel') is-invalid @enderror" name="artikel" required autofocus></textarea>
                        @error('artikel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Tambah') }}
                        </button>
                        <a href="{{ route('daftar-artikel.index') }}" class="btn btn-secondary">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'artikel', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection
