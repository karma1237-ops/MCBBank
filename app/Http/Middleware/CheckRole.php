<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    // Laisse passer seulement si l'utilisateur connecté a le bon rôle (manager, cashier ou client)
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (session('role') != $role) {
            return redirect('/login')->with('error', 'Veuillez vous connecter');
        }

        // Pour le client : on partage ses infos avec toutes les vues (solde dans la navbar)
        if ($role == 'client') {
            $client = DB::table('accounts')->where('id', session('client_id'))->first();
            view()->share('client', $client);
        }

        return $next($request);
    }
}
