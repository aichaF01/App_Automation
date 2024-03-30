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
    @if($t->isEmpty())
            <div class="alert alert-info m-3" role="alert">
                 <h2>Aucun ticket trouvé.</h2>
            </div>
        @else
        <div class="container mt-5">
            <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>Numéro du ticket</th>
                            <th>Titre de ticket</th>
                            <th>Description de ticket</th>
                            <th>Email de créateur</th>
                            <th>Type de ticket</th>
                            <th>Traité par</th>
                            <th>Statut de ticket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($t as $ticket)
                        <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->titre_ticket}}</td>
                            <td>{{$ticket->description_ticket}}</td>
                            <td>{{$ticket->email_créateur}}</td>
                            <td>{{$ticket->nom}}</td>
                            <td>
                                @if($ticket->statut_ticket == "Ouvert")
                                    <p class="text-danger">Non traité</p>
                                @endif
                                @if($ticket->statut_ticket == "En cours de traitement" || $ticket->statut_ticket == "Résolu")
                                    <p>{{$ticket->name}}</p>
                                @endif
                            </td>
                            <td>
                                @if($ticket->statut_ticket == "Ouvert")
                                    <button class="btn btn-danger">{{$ticket->statut_ticket}}</button>
                                @elseif($ticket->statut_ticket == "En cours de traitement")
                                    <button class="btn btn-warning">En cours</button>
                                @elseif($ticket->statut_ticket == "Résolu")
                                    <button class="btn btn-success">{{$ticket->statut_ticket}}</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
            <div class="row">{{$t->links()}}</div>
        </div>
    @endif
</body>
</html>