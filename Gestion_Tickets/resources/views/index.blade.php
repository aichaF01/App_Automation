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
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <div class="row">
                                <th class="col-md-2 col-lg-1">Numéro du ticket</th>
                                <th class="col-md-2 col-lg-1">Titre de ticket</th>
                                <th class="col-md-4 col-lg-4">Description de ticket</th>
                                <th>Email de créateur</th>
                                <th>Type de ticket</th>
                                <th class="col-md-2 col-lg-1">Traité par</th>
                                <th class="col-md-2 col-lg-3">Statut de ticket</th>
                                <th class="col-md-2 col-lg-2">Actions</th>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($t as $ticket)
                            <tr>
                                <td>{{$ticket->id}}</td>
                                <td>{{$ticket->titre_ticket}}</td>
                                <td>{{$ticket->description_ticket}}</td>
                                <td>{{$ticket->email_créateur}}</td>
                                <td class="label">{{$ticket->nom}}</td>
                                <td>
                                    @if($ticket->statut_ticket == "Ouvert")
                                        <p class="text-danger">Non traité</p>
                                    @endif
                                        @if($ticket->statut_ticket == "En cours de traitement")
                                        <p>{{$ticket->name}}</p>
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->statut_ticket == "Ouvert")
                                        <button class="btn btn-warning">Passer à en cours ...</button>
                                    @endif
                                        @if($ticket->statut_ticket == "En cours de traitement")
                                        <button class="btn btn-success">Passer à Résolu ...</button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success">
                                        @if($ticket->statut_ticket == "Ouvert")
                                            <a class="link-light link-underline link-underline-opacity-0" href="{{ route('ticket.edit', ['id' => $ticket->id]) }}"><i class="fa-solid fa-eye-slash"></i></a>
                                        @endif
                                        @if($ticket->statut_ticket == "En cours de traitement")
                                            <a class="link-light link-underline link-underline-opacity-0" href="{{ route('ticket.edit', ['id' => $ticket->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                        @endif
                                    </button>
                                    <form class="d-inline" method="POST" action="{{ route('ticket.delete', ['id' => $ticket->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette ticket ?')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row"> {{$t->links()}} </div>
        </div>
    @endif
</body>
</html>