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


    public static function register(){
      View::make('register.html');
    }
  }
