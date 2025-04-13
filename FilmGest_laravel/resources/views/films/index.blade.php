<html>
    <head>
        <title>Page</title>
    </head>
    <body>
        <h1>Liste des Films</h1>
        <a href="{{ route('films.create')}}">Ajouter un Film</a>

        @foreach ($films as $film)
        <div>
            <h2>{{ $film->title }}</h2>
            <p><strong>Genre :</strong>{{ $film->genre->name }}</p>
            <p><strong></strong></p>
        </div>
        @endforeach
    </body>
</html>