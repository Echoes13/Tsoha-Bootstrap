<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/pokedex', function() {
    HelloWorldController::pokedex();
  });

  $routes->get('/pokedex/1', function() {
    HelloWorldController::pokemon();
  });

  $routes->get('/pokedex/1/1', function() {
    HelloWorldController::pokemon_update();
  });

  $routes->get('/pokedex/1/2', function() {
    HelloWorldController::pokenest();
  });

  $routes->get('/trainer', function() {
    HelloWorldController::trainer();
  });

  $routes->get('/trainer/1', function() {
    HelloWorldController::trainer_update();
  });

  $routes->get('/trainer/2', function() {
    HelloWorldController::own_pokemon_update();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });
