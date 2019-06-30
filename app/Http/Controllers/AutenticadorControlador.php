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
    		'nome' => 'required|string',
    		'email' => 'required|string|email|unique:users',
    		'senha' => 'required|string|confirmed'		
    	]);

    	$usuario = new User([
    		'nome' => $request->nome,
    		'email' => $request->email,
    		'senha' => bcrypt($request->senha)   	
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
    		'senha' => 'required|string'		
    	]);

    	$credenciais = [
    		'email' => $request->email,
    		'senha' => $request->senha
    	];

    	if Auth::attempt($credenciais)
    		return response()->json([
    			'resposta' => 'Acesso negado'
    		], 401);

    	$usuario = $request->user();
    	$token = $usuario->createToken('Token de acesso')->accessToken();
    	return response()->json([
    		'toke' => $token
    	], 200);
    }

    public function logout(Request $request)
    {
    	$request->user()->token()->revoke();
    	return response()->json([
    		'resposta' =: 'Deslogado com sucesso'
    	]);
    }
}
