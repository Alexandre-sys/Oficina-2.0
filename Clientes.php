<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

    protected $fillable = [
    	'nome',
    	'email',
    	'data',
    	'vendedor',
    	'produtos',
    	'valor'

    ];

    public function pesquisar(Array $dados)
    {
    	$filtros = $this->where(function($query) use ($dados)
    	{
    		if (isset($dados['data-inicial']) && isset($dados['data-final']))
    			$query->whereBetween('data', [$dados['data-inicial'], $dados['data-final']]);  		
    		if (isset($dados['nome-cliente']))
    			$query->where('nome', 'LIKE', '%' .$dados['nome-cliente']. '%');
    		if (isset($dados['nome-vendedor']))
    			$query->where('vendedor', 'LIKE', '%' .$dados['nome-vendedor']. '%');
    	})->get(); 

        return $filtros;
    }

}
