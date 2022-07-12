@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <h1>{{ $article->judul }}</h1>
            <div class="col-md-6">
                <div class="row text-secondary">
                    <p>{{ $article->author }} - {{ date('l, d F Y h:i', strtotime($article->created_at)) }}</p>
                </div>
                <div class="row">
                    {!! $article->artikel !!}
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div class="d-flex justify-content-center sticky-top">
                    <img class="logo mt-5" src="{{ asset('header/') }}/{{$article->header}}" alt="" width="500">
                </div>
            </div>
        </div>
        @guest
        @else        
        <div class="row">
            <form action="{{ route('daftar-artikel.destroy', $article->id) }}" method="POST">
                <a href="{{ route('daftar-artikel.index') }}" class="btn btn-secondary"><i class="fa fa-ban"></i> Cancel</a>
                <a href="{{ route('daftar-artikel.edit', $article->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type='submit'><i class="fa fa-trash"></i> Hapus</button>
            </form>
        </div>
        @endguest
    </div>
</div>
@endsection
