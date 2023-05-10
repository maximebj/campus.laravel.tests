<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projets</title>
</head>
<body>
  <h1>Liste des projets</h1>

  <ol>
    @foreach ($projects as $project)
      <li>
        <a href="/projects/{{ $project->id }}">
          {{ $project->title }}
        </a>
        <p>Publié {{$project->created_at->diffForHumans()}}</p>
        <p>Par {{$project->user->name}}</p>
      </li>
    @endforeach
  </ol>
</body>
</html>