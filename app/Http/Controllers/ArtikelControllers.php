<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ArtikelControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Artikel::all();
        return view('article.index', ['article' => $article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'header' => 'required',
            'judul' => 'required',
            'artikel' => 'required',
        ]);
        $headername = 'header'.'-'.$request->judul.'.'.$request->header->extension();
        $request->header->move(public_path('header'), $headername);
        Artikel::create([
            'header' => $headername,
            'judul' => $request['judul'],
            'slug' => Str::slug($request['judul']),
            'artikel' => $request['artikel'],
            'author' => Auth::user()->name,
        ]);
        return redirect()->route('daftar-artikel.index')->with('success','Data berhasil di input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($judul)
    {
        $article = DB::table('artikels')->where('slug', '=', $judul)->first();
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Artikel::find($id);
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'header' => 'required',
            'judul' => 'required',
            'artikel' => 'required',
        ]);
        $article = Artikel::find($id);

        if (!empty($request->header)){
            $headername = 'header'.'-'.$request->judul.'.'.$request->header->extension();
            $request->header->move(public_path('header'), $headername);

            $article->header = $headername;
        }
        $article->judul = $request['judul'];
        $article->slug = Str::slug($request['judul']);
        $article->artikel = $request['artikel'];

        $article->save();
        return redirect()->route('daftar-artikel.index')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Artikel::find($id);
        $article->delete();
        unlink(public_path().'/header/'.$article->header);
        return redirect()->route('daftar-artikel.index')->with('success','Artikel berhasil dihapus');
    }

    public function list()
    {
        $artikel = DB::table('artikels')->latest()->get();
        return view('welcome', ['artikel' => $artikel]);
    }
}
