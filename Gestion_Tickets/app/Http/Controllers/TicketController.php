<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(){
        $t = DB::table('tickets')
        ->select('tickets.id', 'tickets.titre_ticket', 'tickets.description_ticket', 'tickets.email_créateur', 'types.nom', 'tickets.statut_ticket', 'users.name')
        ->leftJoin("types", "tickets.type_id", "=", "types.id")
        ->leftJoin("users", "tickets.user_id", "=", "users.id")
        ->where("tickets.statut_ticket", "!=", "Résolu")
        ->paginate(5);
        // dd($t);
        return view('index',compact('t'));
    }
    public function create(){
        //get all type de ticket
        $types = DB::table('types')->get();
        return view('create',compact('types'));
    }
    public function edit($id){
        $t = DB::table('tickets')
            ->select('tickets.id', 'tickets.titre_ticket', 'tickets.description_ticket', 'tickets.email_créateur', 'users.name', 'tickets.statut_ticket')
            ->leftJoin("users", "tickets.user_id", "=", "users.id")
            ->where("tickets.statut_ticket", "!=", "Résolu")
            ->where('tickets.id', '=', $id)
            ->first();
        return view('edit', compact('t'));
    }
    public function insert(Request $request){
        // dd($request);
        $request->validate([
            'titre_ticket' => 'required',
            'description_ticket' => 'required',
            'email_createur' => 'required|email',
            'type_id' => 'required'
        ]);
        $ticket = new Ticket();
        $ticket->titre_ticket = $request->titre_ticket;
        $ticket->description_ticket = $request->description_ticket;
        $ticket->email_créateur = $request->email_createur;
        $ticket->date_creation = $request->filled('date_creation') ? $request->date_creation : now();
        $ticket->statut_ticket = $request->filled('statut_ticket') ? $request->statut_ticket : 'Ouvert';

        $ticket->type_id = $request->type_id;
        $ticket->auth_id = auth()->id();

        $ticket->save();
        return redirect()->route('create')->with('success', 'Le ticket a été ajouté avec succès.');
    }
    public function update(Request $request, $id){
        $ticket = Ticket::findOrFail($id);
        if ($ticket->statut_ticket == "En cours de traitement") {
            $ticket->statut_ticket = $request->statut_ticket;
        } elseif ($ticket->statut_ticket == "Ouvert" && auth()->check()) {
            $ticket->user_id = auth()->id();
            $ticket->statut_ticket = $request->statut_ticket;
        }
        $ticket->save();
        
        return redirect()->route('ticket.index')->with('success', 'Le ticket a été modifié avec succès.');
    }
    public function delete(Request $request){
        DB::table('tickets')->where('id',$request->id)->delete();
        return redirect()->route('ticket.index')->with('success', 'Le ticket a été supprimé avec succès.');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    public function users(){
        $u = DB::table('users')->where("users.type_user", "!=", "admin")->paginate(5);
        return view('users',compact('u'));
    }
    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);
        if ($user->type_user == "user") {
            $user->type_user = "admin";
        }
        $user->save();
        
        return redirect()->route('users');
    }
    public function ticketsUser(){
        // dd(auth()->user()->email);
        $t = DB::table('tickets')
            ->select('tickets.id', 'tickets.titre_ticket', 'tickets.description_ticket', 'tickets.email_créateur', 'types.nom', 'tickets.statut_ticket', 'users.name')
            ->leftJoin("types", "tickets.type_id", "=", "types.id")
            ->leftJoin("users", "tickets.user_id", "=", "users.id")
            ->where('tickets.auth_id', '=', auth()->id())
            ->paginate(5);
            // dd($t);
        return view('ticketsUser',compact('t'));
    }
    public function ShowForm(Request $request){
        return view('addUser');
    }
    public function addUser(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type_user = "user";

        $user->save();
        return redirect()->route('users')->with('success', 'Le ticket a été ajouté avec succès.');
    }
}
