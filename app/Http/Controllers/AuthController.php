<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Affiche la page de connexion
    public function showLogin()
    {
        return view('login');
    }

    // Vérifie l'email et le mot de passe selon le bouton cliqué
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Connexion Client
        if ($request->has('userLogin')) {
            $account = DB::table('accounts')->where('email', $request->email)->first();
            if ($account && Hash::check($request->password, $account->password)) {
                session(['role' => 'client', 'client_id' => $account->id]);
                return redirect('/client/home');
            }
        }

        // Connexion Manager (admin) ou Caissier : table staff
        if ($request->has('managerLogin') || $request->has('cashierLogin')) {
            $type = $request->has('managerLogin') ? 'manager' : 'cashier';
            $staff = DB::table('staff')->where('email', $request->email)->where('type', $type)->first();
            if ($staff && Hash::check($request->password, $staff->password)) {
                session(['role' => $type, 'staff_id' => $staff->id]);
                if ($type == 'manager') {
                    return redirect('/admin/home');
                }
                return redirect('/cashier/home');
            }
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    // Déconnexion : on vide la session
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
