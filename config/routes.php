<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  //Sovelluksen yleisreitit

  $routes->get('/', function() {
    HomeController::index();
  });

  //$routes->get('/register', function() {
  //  HelloWorldController::register();
  //});

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

  $routes->get('/trainer', 'check_logged_in', function() {
    TrainerController::index();
  });

  $routes->get('/trainer/edit', 'check_logged_in', function() {
    TrainerController::edit();
  });

  $routes->post('/trainer/edit', function() {
    TrainerController::update();
  });


  //Kouluttajan pokémoneihin liittyvät reitit

  $routes->get('/trainer/new', 'check_logged_in', function() {
    PokemonController::pokemon_add();
  });

  $routes->post('/trainer/new', function() {
    PokemonController::store();
  });

  $routes->get('/trainer/edit/:id', 'check_logged_in', function($id) {
    PokemonController::pokemon_update($id);
  });

  $routes->post('/trainer/edit/:id', function($id) {
    PokemonController::update($id);
  });

  $routes->post('/trainer/destroy/:id', function($id) {
    PokemonController::destroy($id);
  });
  $routes->get('/trainer/type/:type', function($type) {
    PokemonController::findType($type);
  });


