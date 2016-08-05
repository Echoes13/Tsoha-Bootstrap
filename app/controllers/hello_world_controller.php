<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('sandbox.html');;
    }


    public static function trainer(){
      View::make('trainer.html');
    }

    public static function trainer_update(){
      View::make('trainer_update.html');
    }

    public static function own_pokemon_update(){
      View::make('own_pokemon_update.html');
    }

    public static function pokedex(){
      View::make('pokedex.html');
    }

    public static function pokemon(){
      View::make('pokemon.html');
    }

    public static function pokenest(){
      View::make('pokenest.html');
    }

    public static function pokemon_update(){
      View::make('pokemon_update.html');
    }

    public static function login(){
      View::make('login.html');
    }
  }
