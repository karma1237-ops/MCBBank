<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Contrôleur de l'espace Client.
 * Les pages sont protégées par le middleware role:client (routes/web.php),
 * qui envoie aussi la variable $client à toutes les vues.
 */
class ClientController extends Controller
{
    // Page d'accueil du client avec la dernière notice reçue
    public function home()
    {
        $notice = DB::table('notices')->where('account_id', session('client_id'))->latest()->first();
        return view('Client.home', ['notice' => $notice]);
    }

    // Détails du compte bancaire
    public function account()
    {
        // $client est déjà envoyé à toutes les vues par le middleware CheckRole
        return view('Client.accounts');
    }

    // Transfert - étape 1 : saisir le numéro de compte du destinataire
    public function transfer()
    {
        return view('Client.transfer', ['history' => $this->history()]);
    }

    // Transfert - étape 2 : afficher les infos du destinataire et saisir le montant
    public function transferinfo(Request $request)
    {
        $request->validate(['otherNo' => 'required']);

        $receiver = DB::table('accounts')->where('accountNo', $request->otherNo)->first();
        if (!$receiver) {
            return redirect('/client/transfer')->with('error', 'Aucun compte ne correspond à ce numéro');
        }
        if ($receiver->id == session('client_id')) {
            return redirect('/client/transfer')->with('error', 'Vous ne pouvez pas transférer vers votre propre compte');
        }

        return view('Client.transfe', ['receiver' => $receiver, 'history' => $this->history()]);
    }

    // Transfert - étape 3 : effectuer le transfert
    public function savetransfer(Request $request)
    {
        $request->validate([
            'otherNo' => 'required|exists:accounts,accountNo',
            'amount' => 'required|numeric|min:1',
        ]);

        $me = DB::table('accounts')->where('id', session('client_id'))->first();
        $receiver = DB::table('accounts')->where('accountNo', $request->otherNo)->first();

        if ($me->balance < $request->amount) {
            return redirect('/client/transfer')->with('error', 'Solde insuffisant');
        }

        // DB::transaction : soit tout est fait, soit rien (pas d'argent perdu en cas d'erreur)
        DB::transaction(function () use ($me, $receiver, $request) {
            DB::table('accounts')->where('id', $me->id)->decrement('balance', $request->amount);
            DB::table('accounts')->where('id', $receiver->id)->increment('balance', $request->amount);

            // Une ligne "débit" pour l'émetteur, une ligne "crédit" pour le destinataire
            DB::table('transactions')->insert([
                'account_id' => $me->id,
                'action' => 'transfer',
                'debit' => $request->amount,
                'other' => $receiver->accountNo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('transactions')->insert([
                'account_id' => $receiver->id,
                'action' => 'transfer',
                'credit' => $request->amount,
                'other' => $me->accountNo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect('/client/transfer')->with('status', 'Transfert de Rs.'.$request->amount.' effectué avec succès');
    }

    // Historique des transferts envoyés par le client
    private function history()
    {
        return DB::table('transactions')
            ->where('account_id', session('client_id'))
            ->where('action', 'transfer')
            ->whereNotNull('debit')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Relevé bancaire : toutes les opérations du client, 10 par page
    public function statements()
    {
        $transactions = DB::table('transactions')
            ->where('account_id', session('client_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('Client.statements', ['transactions' => $transactions]);
    }

    // Formulaire de feedback
    public function feedback()
    {
        return view('Client.feedback');
    }

    // Enregistrer le feedback
    public function savefeedback(Request $request)
    {
        $request->validate(['msg' => 'required']);

        DB::table('feedbacks')->insert([
            'account_id' => session('client_id'),
            'message' => $request->msg,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/client/feedback')->with('status', 'Votre message a été envoyé avec succès');
    }

    // Liste des notices reçues
    public function notice()
    {
        $notices = DB::table('notices')
            ->where('account_id', session('client_id'))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Client.notice', ['notices' => $notices]);
    }
}
