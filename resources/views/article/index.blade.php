@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <h3 class="title">Daftar Artikel</h3>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="{{ route('daftar-artikel.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Artikel</a>
            </div>
        </div>
        <div class="row">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">No</td>
                        <td scope="col">Judul Artikel</td>
                        <td scope="col">Author</td>
                        <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($article as $arc)
                    <tr>
                        <th scope="row">{{ $loop->iteration}}</th>
                        <td>{{ $arc->judul }}</td>
                        <td>{{ $arc->author }}</td>
                        <td>
                            <form action="{{ route('daftar-artikel.destroy', $arc->id) }}" method="POST">
                                <a href="{{ route('daftar-artikel.show',$arc->slug) }}" class="btn btn-info"><i class="fa fa-info-circle"></i> Detail</a>
                                <a href="{{ route('daftar-artikel.edit',$arc->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type='submit'><i class="fa fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
