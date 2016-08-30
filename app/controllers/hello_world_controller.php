<?php

  class HelloWorldController extends BaseController{

    public static function index(){
       
      $hyvaksymatta = Osallistuminen::hyvaksymatta();
      View::make('home.html', array('hyvaksymatta' => $hyvaksymatta));
    }
    
    public static function login() {
        View::make('login.html');
    }
    

    public static function sandbox(){
      // Testaa koodiasi täällä
        
      View::make('hello.html');
    }
  }
