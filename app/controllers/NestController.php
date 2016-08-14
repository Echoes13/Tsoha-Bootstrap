<?php

class NestController extends BaseController {
	
	
	//Pesän lisääminen

	public static function create($nr){
		$poke = Pokemon::find($nr);
		View::make('pokedex/pokenest.html', array('poke' => $poke));
	}

	public static function store($nr) {
		$params = $_POST;
		$attributes = array(
			'city' => $params['city'],
			'place' => $params['place']
			);

		$nest = new Pokenest(array(
			'pokemon_id' => $nr,
			'location' => $params['city'] . ', ' . $params['place']
			));

		if(strlen($attributes['city']) < 3 ||
			strlen($attributes['place']) < 10){

			View::make('pokedex/pokenest.html', array('error' => 'Tarkenna pesän tietoja!', 'attributes' => $attributes));
		}else{
			$nest->save();

			Redirect::to('/pokedex/' . $nr, array('message' => 'Pesä on lisätty pokémonille!'));
		}
	}


	//Pesän poistaminen

	public static function destroy($nr, $location){
		$poke = new Pokenest(array(
			'pokemon_id' => $nr,
			'location' => $location
			));
		$poke->destroy();

		Redirect::to('/pokedex/' . $nr . '/edit', array('message' => 'Pesän tiedot on poistettu!'));
	}

}