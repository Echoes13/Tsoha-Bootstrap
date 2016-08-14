<?php

class PokedexController extends BaseController {
	public static function index(){
		$pokes = Pokemon::all();
		View::make('pokedex/index.html', array('pokes' => $pokes));
	}

	public static function show($nr){
		$poke = Pokemon::find($nr);
		$nests = Pokenest::findForPokemon($nr);
		View::make('pokedex/pokemon.html', array('poke' => $poke, 'nests' => $nests));
	}

	public static function showType($type){
		$pokes = Pokemon::findType($type);
		View::make('pokedex/type.html', array('pokes' => $pokes, 'type' => $type));
	}


	//Pokémonin lisääminen

	public static function create(){
		View::make('pokedex/new.html');
	}

	public static function store(){
		$params = $_POST;
		if($params['type2'] == '') {
        	$params['type2'] = null;
		}

		$attributes = array(
			'nr' => $params['nr'],
			'name' => $params['name'],
			'type1' => $params['type1'],
			'type2' => $params['type2'],
			'description' => $params['description']
		);

		$poke = new Pokemon($attributes);
		$errors = $poke->errors();

		if(count($errors) == 0){
			$poke->save();
		
			Redirect::to('/pokedex/' . $poke->nr, array('message' => 'Pokémon on lisätty Pokédexiin!'));
		}else{
			View::make('pokedex/new.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}


	//Pokémonin tietojen muokkaaminen

	public static function edit($nr){
		$poke = Pokemon::find($nr);
		$nests = Pokenest::findForPokemon($nr);
		View::make('pokedex/edit.html', array('attributes' => $poke, 'nests' => $nests));
	}

	public static function update($nr){
		$params = $_POST;

		$attributes = array(
			'nr' => $nr,
			'name' => $params['name'],
			'type1' => $params['type1'],
			'type2' => $params['type2'],
			'description' => $params['description']
		);

		$poke = new Pokemon($attributes);
		$errors = $poke->errors();

		if(count($errors) < 2){
			$poke->update();
		
			Redirect::to('/pokedex/' . $poke->nr, array('message' => 'Pokémonin tietoja muokattu!'));
		}else{
			View::make('pokedex/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	
	//Pokemonin poistaminen

	public static function destroy($nr){
		$poke = new Pokemon(array('nr' => $nr));
		$poke->destroy();

		Redirect::to('/pokedex', array('message' => 'Pokémonin tiedot on poistettu!'));
	}



}