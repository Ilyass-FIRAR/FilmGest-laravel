<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Film</title>
</head>
<body>
    <h1>Ajouter un nouveau Film</h1>

    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" required><br>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="genre_id">Genre :</label>
        <select name="genre_id" id="genre_id" required>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select><br>

        <label for="poster">Affiche (image) :</label>
        <input type="file" name="poster" id="poster" accept="image/*"><br>

        <label for="actors">Acteurs (séparés par des virgules) :</label>
        <input type="text" name="actors[]" multiple><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
