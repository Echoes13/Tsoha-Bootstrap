<?php

class PokemonController extends BaseController {
  public static function findType($type){
    $user = parent::get_user_logged_in();
    $pokes = OwnedPokemon::findType($user->id, $type);
    $types = Pokemon::typeList();
    View::make('user/trainer.html', array('pokes' => $pokes, 'types' => $types));
  }


  //Omien pokémonien lisääminen

  public static function pokemon_add(){
    $pokes = Pokemon::all();
  	View::make('pokemon/own_pokemon_add.html', array('pokes' => $pokes));
  }

  public static function store(){
    $params = $_POST;
    if($params['nick'] == '') {
          $params['nick'] = Pokemon::find($params['pokemon_id'])->name;
    }

    $user = parent::get_user_logged_in();

    $attributes = array(
      'trainer_id' => $user->id,
      'id' => ++$user->caught,
      'pokemon_id' => $params['pokemon_id'],
      'nick' => $params['nick']
    );

    $poke = new OwnedPokemon($attributes);
    $errors = $poke->errors();

    if(count($errors) == 0){
      $poke->save();
      $user->update_lc();
    
      Redirect::to('/trainer', array('message' => $poke->nick . ' on lisätty omistamiisi Pokémoneihin!'));
    }else{
      $pokes = Pokemon::all();
      View::make('pokemon/own_pokemon_add.html', array('errors' => $errors, 'attributes' => $attributes, 'pokes' => $pokes));
    }
  }


  //Omien pokémonien tietojen muokkaaminen

  public static function pokemon_update($id){
      $user = parent::get_user_logged_in();
      $poke = OwnedPokemon::find($user->id, $id);
      $pokes = Pokemon::all();
    	View::make('pokemon/own_pokemon_update.html', array('attributes' => $poke, 'pokes' => $pokes));
  }

  public static function update($id){
    $params = $_POST;

    $user = parent::get_user_logged_in();

    $attributes = array(
      'trainer_id' => $user->id,
      'id' => $id,
      'pokemon_id' => $params['pokemon_id'],
      'nick' => $params['nick']
    );

    $poke = new OwnedPokemon($attributes);
    $errors = $poke->update_errors();

    if(count($errors) == 0){
      $poke->update();
    
      Redirect::to('/trainer', array('message' => 'Pokémonin tietoja muokattu!'));
    }else{
      $pokes = Pokemon::all();
      View::make('pokemon/own_pokemon_update.html', array('errors' => $errors, 'attributes' => $attributes, 'pokes' => $pokes));
    }
  }

  //Omien Pokemonien poistaminen

  public static function destroy($id){
    $user = parent::get_user_logged_in();
    $poke = new OwnedPokemon(array('trainer_id' => $user->id, 'id' => $id));
    $poke->destroy();

    Redirect::to('/trainer', array('message' => 'Pokémonin tiedot on poistettu!'));
  }

}