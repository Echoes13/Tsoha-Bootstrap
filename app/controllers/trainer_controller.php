<?php

class TrainerController extends BaseController {
	public static function index(){
    $user = parent::get_user_logged_in();
    $pokes = OwnedPokemon::all($user->id);
    $types = Pokemon::typeList();
    View::make('user/trainer.html', array('pokes' => $pokes, 'types' => $types));
  }



  //Kouluttajan tietojen muuttaminen

	public static function edit(){
    $user = parent::get_user_logged_in();
    $min_caught = OwnedPokemon::find_max($user->id);

    if(is_null($min_caught)){
      $min_caught = 0;
    }

    View::make('user/trainer_update.html', array('min_caught' => $min_caught));
  }


  public static function update(){
    $params = $_POST;

    $user = parent::get_user_logged_in();

    $user->level = $params['level'];
    $user->caught = $params['caught'];

    $user->update_lc();

    $user = parent::get_user_logged_in();
    $pokes = OwnedPokemon::all($user->id);
    Redirect::to('/trainer', array('pokes' => $pokes));
  }

}