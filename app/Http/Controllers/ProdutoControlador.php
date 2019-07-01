<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    public function index(){
    	//teste return api
    	return response()->json([
    		['id' => 1, 'nome' => 'Produto 1'],
			['id' => 2, 'nome' => 'Produto 2'],
    		['id' => 3, 'nome' => 'Produto 1'],

    	]);
    }
}
