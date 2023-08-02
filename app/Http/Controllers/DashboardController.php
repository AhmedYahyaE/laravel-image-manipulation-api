<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        // Retrieving the authenticated/logged-in user
        $user = $request->user();


        return view('dashboard', [
            // Retrieving the authenticated/logged-in user's tokens
            'tokens' => $user->tokens
        ]);
    }

    public function showTokenForm ()
    {
        return view('token-create');
    }

    public function createToken(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $tokenName = $request->post('name');

        // Retrieving the authenticated/logged-in user
        $user = $request->user(); 
        $token = $user->createToken($tokenName); // createToken() method comes from the HasApiTokens trait in User.php model

        return view('token-show', [
            'tokenName' => $tokenName,
            'token'     => $token->plainTextToken
        ]);
    }

    public function deleteToken(PersonalAccessToken $token)
    {
        $token->delete();

        return redirect('dashboard');
    }
}