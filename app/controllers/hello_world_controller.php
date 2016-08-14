<?php
  
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }

    public static function sandbox(){

      $missingno = new Pokemon(array(
        'nr' => '722',
        'name' => 'm',
        'type1' => 'water',
        'type2' => '',
        'description' => ''
        ));
      $errors = $missingno->errors();

      Kint::dump($errors);
    }


    public static function trainer(){
      View::make('user/trainer.html');
    }

    public static function trainer_update(){
      View::make('trainer_update.html');
    }

    public static function own_pokemon_update(){
      View::make('own_pokemon_update.html');
    }

    public static function login(){
      View::make('login.html');
    }

    public static function register(){
      View::make('register.html');
    }
  }
