<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AutenticadorControlador extends Controller
{
    public function registro(Request $request)
    {
    	$request->validate([
    		'name' => 'required|string',
    		'email' => 'required|string|email|unique:users',
    		'password' => 'required|string|confirmed'		
    	]);

    	$usuario = new User([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password)   	
    	]);

    	$usuario->save();

    	return response()->json([
    		'resposta' => 'Usuário criado com sucesso'
    	], 201);
    }

    Public function login(Request $request)
    {
    	$request->validate([
    		'email' => 'required|string|email',
    		'password' => 'required|string'		
    	]);

    	$credenciais = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	if (!Auth::attempt($credenciais))
    		return response()->json([
    			'resposta' => 'Acesso negado'
    		], 401);

    	$user = $request->user();

    	$token = $user->createToken('Token de acesso')->accessToken;

    	return response()->json([
    		'token' => $token
    	], 200);
    }

    public function logout(Request $request)
    {
    	$request->user()->token()->revoke();
    	return response()->json([
    		'resposta' => 'Deslogado com sucesso'
    	]);
    }

    public function ativarregistro($id, $token) {
        
    }
}
