<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }
    
    public static function login() {
        View::make('login.html');
    }
    
    public static function fuksit() {
        View::make('fuksit.html');
    }
    
    public static function tapahtumat() {
        View::make('tapahtumat.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        
      View::make('hello.html');
    }
  }
