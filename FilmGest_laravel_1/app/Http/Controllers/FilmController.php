<?php
namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    // ✅ Show all films
    public function index()
    {
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    // ✅ Show the form to create a new film
    public function create()
    {
        $genres = Genre::all();
        return view('films.create',compact('genres'));   
    }

    // ✅ Store a new film
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string|max:80',
            'description' => 'required|string',
            'genre_id' => 'required', // ❗ fixed 'exists' rule
            'poster' => 'required|image',
            'actors' => 'required|array' // ❗ assuming multiple actor IDs
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // ✅ Store poster
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
        }

        // ✅ Save film
        $film = new Film();
        $film->title = $request->title;
        $film->description = $request->description;
        $film->genre_id = $request->genre_id;
        $film->poster = $path;
        $film->save();

        // ✅ Attach actors (many-to-many)
        $film->actors()->attach($request->actors);

        return redirect()->route('films.index')->with('success', 'Film added successfully');
    }

    // ✅ Show a single film
    public function show($id)
    {
        $film = Film::findOrFail($id);
        return view('films.show', compact('film'));
    }

    // ✅ Show edit form
    public function edit(string $id)
    {
        $film = Film::findOrFail($id);
        return view('films.edit', compact('film'));
    }

    // ⚠️ Update method needs real update logic (here's a basic fix)
    public function update(Request $request, string $id)
    {
        $film = Film::findOrFail($id);

        $film->title = $request->title;
        $film->description = $request->description;
        $film->genre_id = $request->genre_id;

        if ($request->hasFile('poster')) {
            // Delete old one
            Storage::disk('public')->delete($film->poster);
            $film->poster = $request->file('poster')->store('posters', 'public');
        }

        $film->save();

        $film->actors()->sync($request->actors);

        return redirect()->route('films.index')->with('success', 'Film updated successfully');
    }

    // ✅ Delete a film
    public function destroy(string $id)
    {
        $film = Film::findOrFail($id);
        if ($film->poster) {
            Storage::disk('public')->delete($film->poster);
        }
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film deleted successfully');
    }
}