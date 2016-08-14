<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  //Sovelluksen yleisreitit

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/register', function() {
    HelloWorldController::register();
  });

  $routes->get('/login', function() {
    UserController::login();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->post('/logout', function() {
    UserController::logout();
  });


  //Pokedexin reitit

  $routes->get('/pokedex', function() {
    PokedexController::index();
  });

  $routes->post('/pokedex', function(){
    PokedexController::store();
  });

  $routes->get('/pokedex/new', 'check_logged_in', function(){
    PokedexController::create();
  });

  $routes->get('/pokedex/type/:type', function($type) {
    PokedexController::showType($type);
  });

  $routes->get('/pokedex/:nr', function($nr) {
    PokedexController::show($nr);
  });

  $routes->get('/pokedex/:nr/edit', 'check_logged_in', function($nr) {
    PokedexController::edit($nr);
  });

  $routes->post('/pokedex/:nr/edit', function($nr) {
    PokedexController::update($nr);
  });

  $routes->post('/pokedex/:nr/destroy', function($nr) {
    PokedexController::destroy($nr);
  });


  //Pesiin liittyvät reitit

  $routes->post('/pokedex/:nr', function($nr){
    NestController::store($nr);
  });

  $routes->get('/pokedex/:nr/nest', 'check_logged_in', function($nr) {
    NestController::create($nr);
  });

  $routes->post('/pokedex/:nr/nest/:location', function($nr, $location){
    NestController::destroy($nr, $location);
  });


  //Kouluttajaan liittyvät reitit

  $routes->get('/trainer', function() {
    HelloWorldController::trainer();
  });

  $routes->get('/trainer/1', function() {
    HelloWorldController::trainer_update();
  });

  $routes->get('/trainer/2', function() {
    HelloWorldController::own_pokemon_update();
  });

