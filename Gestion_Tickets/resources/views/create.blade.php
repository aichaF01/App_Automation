<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('/navigation')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Créer un Ticket :</h1>
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <form method='POST' action="{{ route('ticket.insert') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Titre de ticket: </label>
                                    <input type="text" name="titre_ticket" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Description de ticket: </label>
                                    <textarea name="description_ticket" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Date de création de ticket: </label>
                                    <input type="datetime-local" name="date_creation" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email de créateur: </label>
                                    <input type="email" name="email_createur" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Type de ticket: </label>
                                    <select name="type_id" class="form-select">
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Ajouter le ticket</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>