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
                        <h1>Vérifier le Ticket :</h1>
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <form method='POST' action="{{ route('ticket.update', ['id' => $t->id]) }}">
                                @csrf
                                @method('PUT') <!-- Ajout de la méthode PUT pour l'update -->
                                <div class="mb-3">
                                    <label for="titre_ticket" class="form-label">Titre de ticket: </label>
                                    <input type="text" id="titre_ticket" name="titre_ticket" class="form-control" value="{{ $t->titre_ticket }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="description_ticket" class="form-label">Description de ticket: </label>
                                    <textarea id="description_ticket" name="description_ticket" class="form-control" disabled>{{ $t->description_ticket }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="email_créateur" class="form-label">Email de créateur: </label>
                                    <input type="email" id="email_créateur" name="email_créateur" class="form-control" value="{{ $t->email_créateur }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Statut du ticket:</label><br>
                                    <select name="statut_ticket" class="form-select" required>
                                        <option value="En cours de traitement" {{ $t->statut_ticket == 'En cours de traitement' ? 'selected' : '' }}>En cours de traitement</option>
                                        <option value="Résolu" {{ $t->statut_ticket == 'Résolu' ? 'selected' : '' }}>Résolu</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Vérifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>