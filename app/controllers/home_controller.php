<?php

class HomeController extends BaseController {
	public static function index(){
      View::make('home.html');
    }
}