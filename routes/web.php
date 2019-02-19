<?php


use App\Cliente;
use App\Endereco;

Route::get('/',function(){
	return view('layout');
});

Route::get('/clientesjuntos', function () {
	$cli = Cliente::all();
	foreach ($cli as $c) {
		echo "<p>ID: ". $c->id ."</p>";
		echo "<p>Nome: ". $c->nome ."</p>";
		echo "<p>Telefone: ". $c->telefone ."</p>";
		//$e = Endereco::where('cliente_id', $c->id)->first();
		echo "<p>Rua: ". $c->endereco->rua ."</p>";
		echo "<p>Número da casa: ". $c->endereco->numero ."</p>";
		echo "<p>Bairro: ". $c->endereco->bairro ."</p>";
		echo "<p>Cidade: ". $c->endereco->cidade ."</p>";
		echo "<p>Estado: ". $c->endereco->uf ."</p>";
		echo "<hr>";
	}
});

Route::get('/clientes', function () {
	$cli = Cliente::all();
	foreach ($cli as $c) {
		echo "<p>ID:". $c->id ."</p>";
		echo "<p>Nome:". $c->nome ."</p>";
		echo "<p>Telefone:". $c->telefone ."</p>";
		echo "<hr>";
	}
});

Route::get('/enderecosjuntos', function () {
	$end = Endereco::all();
	foreach ($end as $e) {
		echo "<p>ID:". $e->cliente->id ."</p>";
		echo "<p>Nome:". $e->cliente->nome ."</p>";
		echo "<p>Telefone:". $e->cliente->telefone ."</p>";

		echo "<p>Rua:". $e->rua ."</p>";
		echo "<p>Número da casa:". $e->numero ."</p>";
		echo "<p>Bairro:". $e->bairro ."</p>";
		echo "<p>Cidade:". $e->cidade ."</p>";
		echo "<p>Estado:". $e->uf ."</p>";
		echo "<hr>";
	}
});

Route::get('/enderecos', function () {
	$end = Endereco::all();
	foreach ($end as $e) {
		echo "<p>ID:". $e->cliente_id ."</p>";
		echo "<p>Rua:". $e->rua ."</p>";
		echo "<p>Número da casa:". $e->numero ."</p>";
		echo "<p>Bairro:". $e->bairro ."</p>";
		echo "<p>Cidade:". $e->cidade ."</p>";
		echo "<p>Estado:". $e->uf ."</p>";
		echo "<hr>";
	}
});

Route::get('/inserir',function(){
	$c = new Cliente();
	$c->nome = "murilo";
	$c->telefone = "67 99222-7930";
	$c->save();

	$e = new Endereco();
	$e->rua = "rua valerio de almeida";
	$e->numero = "123";
	$e->bairro = "jardim aimore";
	$e->cidade = "campo grande";
	$e->uf = "ms";
	$e->cep = "79000-000";

	$c->endereco()->save($e);



	//OUTRO CLIENTE
	$c = new Cliente();
	$c->nome = "MARIA";
	$c->telefone = "67 99878-7930";
	$c->save();

	$e = new Endereco();
	$e->rua = "rua almeida";
	$e->numero = "9090";
	$e->bairro = "jardim do eden";
	$e->cidade = "campo grande";
	$e->uf = "ms";
	$e->cep = "79000-000";

	$c->endereco()->save($e);
});


Route::get('/clientes/json', function () {
	//$cli = Cliente::all();
	$cli = Cliente::with(['endereco'])->get();
	return $cli->toJson();
	echo "<hr>";
});

Route::get('/endereco/json', function () {
	//$end = Endereco::all();
	$end = Endereco::with(['cliente'])->get();
	return $end->toJson();
	echo "<hr>";
});

Route::get('/clientes/jsonpouco', function () {
	$cli = Cliente::all();
	//$cli = Cliente::with(['endereco'])->get();
	return $cli->toJson();
	echo "<hr>";
});

Route::get('/endereco/jsonpouco', function () {
	$end = Endereco::all();
	//$end = Endereco::with(['cliente'])->get();
	return $end->toJson();
	echo "<hr>";
});