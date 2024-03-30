<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('/navigation')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Ajouter un utilisateur :</h1>
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <form method='POST' action="{{ route('addUser') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Nom d'utilisateur: </label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">E-mail d'utilisateur: </label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Mot de passe d'utilisateur: </label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>