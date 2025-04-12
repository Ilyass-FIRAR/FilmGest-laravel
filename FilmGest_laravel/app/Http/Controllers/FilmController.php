<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filmes=Film::all();
        return view('films.index' , compact('films'));
    }

    public function create()
    {
     return view('films.create');   
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
        
        ]);
    }

    public function show($id)
    {
        $film=Film::findOrFail($id);
        return view('films.show',compact('film'));

    }

    public function edit(string $id)
    {
        $film=Film::findOrFail($id);
        return view('film.edit',compact('film'));
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}
