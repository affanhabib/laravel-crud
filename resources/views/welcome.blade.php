@extends('layouts.app')

@section('content')
<div>
    <div class="d-flex align-items-center">
        <div class="container">
            <h1 class="title">Artikel Kami</h1>
        </div>
    </div>
    <div class="container my-5">
        @foreach ($artikel as $art)
        <div class="mb-4" style="max-width: 750px;">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('/header/') }}/{{ $art->header }}" alt="..." style="max-width: 200px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $art->judul }}</h5>
                        <span class="card-text">
                            {!! $art->artikel = substr($art->artikel, 0, 97) . '...';
                            $art->artikel !!}
                        </span>
                        <p class="card-text"><a href="{{ route('daftar-artikel.show',$art->slug) }}">Selengkapnya</a><br><small class="text-muted">Last updated {{ date('l, d F Y', strtotime($art->updated_at)) }}</small></p>
                    </div>
                </div>
            </div>
            <hr style="background-color: grey">
        </div>
        @endforeach
    </div>
</div>
@endsection
