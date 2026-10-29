<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Contrôleur de l'espace Caissier.
 * Les pages sont protégées par le middleware role:cashier (routes/web.php).
 */
class CashierController extends Controller
{
    // Page d'accueil caissier : rechercher un compte
    public function home()
    {
        return view('Admin.cindex');
    }

    // Afficher le compte trouvé avec le formulaire dépôt / retrait
    public function search(Request $request)
    {
        $request->validate(['otherNo' => 'required']);

        $account = DB::table('accounts')->where('accountNo', $request->otherNo)->first();
        if (!$account) {
            return redirect('/cashier/home')->with('error', 'Aucun compte ne correspond à ce numéro');
        }
        return view('Admin.cindex1', ['account' => $account]);
    }

    // Dépôt (bouton deposit) ou retrait (bouton withdraw)
    public function operation(Request $request)
    {
        $request->validate([
            'otherNo' => 'required|exists:accounts,accountNo',
            'amount' => 'required|numeric|min:1',
        ]);

        $account = DB::table('accounts')->where('accountNo', $request->otherNo)->first();

        if ($request->has('withdraw')) {
            // Retrait
            if ($account->balance < $request->amount) {
                return redirect('/cashier/home')->with('error', 'Solde insuffisant');
            }
            DB::table('accounts')->where('id', $account->id)->decrement('balance', $request->amount);
            DB::table('transactions')->insert([
                'account_id' => $account->id,
                'action' => 'withdraw',
                'debit' => $request->amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = 'Retrait de Rs.'.$request->amount.' effectué';
        } else {
            // Dépôt
            DB::table('accounts')->where('id', $account->id)->increment('balance', $request->amount);
            DB::table('transactions')->insert([
                'account_id' => $account->id,
                'action' => 'deposit',
                'credit' => $request->amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = 'Dépôt de Rs.'.$request->amount.' effectué';
        }

        return redirect('/cashier/home')->with('status', $message.' sur le compte '.$account->accountNo);
    }
}
