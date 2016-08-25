<?php

class TapahtumaController extends BaseController{
  public static function index(){
//    $tapahtumat = Tapahtuma::all();
    View::make('tapahtuma/list.html');
//    View::make('tapahtuma/list.html', array('tapahtumat' => $tapahtumat));
  }
  
  public static function show() {
      View::make('tapahtuma/show.html');
      
  }
  
  public static function edit() {
      View::make('tapahtuma/muokkaa.html');
      
  }
}
