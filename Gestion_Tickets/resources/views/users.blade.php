<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('/navigation')
    @if($u->isEmpty())
        <div class="alert alert-info m-3" role="alert">
            <h2>Aucun utilisateur trouvé.</h2>
        </div>
    @else
        <div class="container mt-5">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>Numéro d'utilisateur</th>
                        <th>Nom d'utilisateur</th>
                        <th>E-mail d'utilisateur</th>
                        <th>Type d'utilisateur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($u as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="d-flex justify-content-between">
                            {{$user->type_user}}
                            <form action="{{ route('updateUser', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-light" title="Devenir admin"><i class="text-primary fa-solid fa-user-slash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form method='POST' action="{{ route('ShowForm') }}">
                @csrf
                <button class="btn btn-primary">Ajouter un utilisateur</button>
            </form>
            <div class="row"> {{$u->links()}} </div>
        </div>
    @endif
</body>
</html>