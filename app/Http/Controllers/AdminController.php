<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Contrôleur de l'espace Admin (Manager).
 * Les pages sont protégées par le middleware role:manager (routes/web.php).
 */
class AdminController extends Controller
{
    // Page d'accueil admin : liste de tous les comptes clients
    public function home()
    {
        $accounts = DB::table('accounts')->orderBy('name', 'asc')->get();
        // Eloquent : $accounts = Account::orderBy('name', 'asc')->get();
        return view('Admin.home', ['accounts' => $accounts]);
    }

    // Formulaire de création de compte bancaire
    public function addnew()
    {
        $accountNo = rand(1000000000, 9999999999); // numéro de compte généré automatiquement
        return view('Admin.maddnew', ['accountNo' => $accountNo]);
    }

    // Enregistrer le nouveau compte bancaire
    public function saveaccount(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cnic' => 'required',
            'accountNo' => 'required|unique:accounts',
            'accountType' => 'required',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:accounts',
            'password' => 'required|min:4',
            'balance' => 'required|numeric|min:500',
            'source' => 'required',
            'number' => 'required',
            'image' => 'required|image',
        ]);

        // La photo est enregistrée dans storage/app/public/photos
        $image = $request->file('image')->store('photos', 'public');

        DB::table('accounts')->insert([
            'name' => $request->name,
            'cnic' => $request->cnic,
            'accountNo' => $request->accountNo,
            'accountType' => $request->accountType,
            'city' => $request->city,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => $request->balance,
            'source' => $request->source,
            'number' => $request->number,
            'image' => $image,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/home')->with('status', 'Le compte de '.$request->name.' a été créé avec succès');
    }

    // Détails d'un client
    public function show($id)
    {
        $account = DB::table('accounts')->where('id', $id)->first();
        // Eloquent : $account = Account::find($id);
        return view('Admin.mshow', ['account' => $account]);
    }

    // Supprimer un compte client
    public function deleteaccount($id)
    {
        DB::table('accounts')->where('id', $id)->delete();
        // Eloquent : Account::find($id)->delete();
        return redirect('/admin/home')->with('status', 'Le compte a été supprimé avec succès');
    }

    // Liste des caissiers
    public function cashiers()
    {
        $cashiers = DB::table('staff')->where('type', 'cashier')->get();
        return view('Admin.maccounts', ['cashiers' => $cashiers]);
    }

    // Ajouter un caissier
    public function savecashier(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:staff',
            'password' => 'required|min:4',
        ]);

        DB::table('staff')->insert([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'cashier',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/cashiers')->with('status', 'Caissier ajouté avec succès');
    }

    // Modifier un caissier
    public function updatecashier(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:staff,email,'.$id,
            'password' => 'required|min:4',
        ]);

        DB::table('staff')->where('id', $id)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);

        return redirect('/admin/cashiers')->with('status', 'Caissier modifié avec succès');
    }

    // Supprimer un caissier
    public function deletecashier($id)
    {
        DB::table('staff')->where('id', $id)->delete();
        return redirect('/admin/cashiers')->with('status', 'Caissier supprimé avec succès');
    }

    // Formulaire pour envoyer une notice à un client
    public function notice($id)
    {
        $account = DB::table('accounts')->where('id', $id)->first();
        return view('Admin.mnotice', ['account' => $account]);
    }

    // Enregistrer la notice
    public function savenotice(Request $request)
    {
        $request->validate([
            'notice' => 'required',
            'userId' => 'required',
        ]);

        DB::table('notices')->insert([
            'account_id' => $request->userId,
            'notice' => $request->notice,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/home')->with('status', 'Notice envoyée avec succès');
    }

    // Liste des feedbacks avec le nom du client (jointure)
    public function feedbacks()
    {
        $feedbacks = DB::table('feedbacks')
            ->join('accounts', 'feedbacks.account_id', '=', 'accounts.id')
            ->select('feedbacks.*', 'accounts.name', 'accounts.accountNo', 'accounts.number')
            ->orderBy('feedbacks.created_at', 'desc')
            ->get();
        return view('Admin.mfeedback', ['feedbacks' => $feedbacks]);
    }

    // Supprimer un feedback
    public function deletefeedback($id)
    {
        DB::table('feedbacks')->where('id', $id)->delete();
        return redirect('/admin/feedbacks')->with('status', 'Feedback supprimé avec succès');
    }
}
