<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        //validate the input
        $request->validate([
            "email" => 'required',
            "password" => 'required',
        ]);

        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($field, $request->email)->first();
        if ($user) {
            if ($request->password == $user->password) {
                $request->session()->put('id', $user->id);
                $request->session()->put('name', $user->name);
                $request->session()->put('username', $user->username);
                $request->session()->put('level', $user->level);
                return redirect('/administration');
            } else {
                return back()->with('fail', "Mot de passe incorrecte pour ce compte. Veuillez contactez l'adminirateur du site .");
            }
        } else {
            return back()->with('fail', "Il n'y a pas de compte qui correspond à cet email dans la base des données ! ");
        }
    }

  

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
