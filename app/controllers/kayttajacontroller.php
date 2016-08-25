<?php
include 'kayttaja.php';

class KayttajaController extends BaseController{
  public static function index() {
//    $kayttajat = Kayttaja::all();
//    View::make('kayttaja/list.html', array('kayttajat' => $kayttajat));
      $essi = new Kayttaja('esmes', 'Essi', 'Esimerkki', 'esmes', false, false);
      $kayttajat = ($essi);
    View::make('kayttaja/list.html', array('kayttajat' => $kayttajat));
    
  }
  
  public static function show() {
      View::make('kayttaja/show.html');
      
  }
  
  public static function edit() {
      View::make('kayttaja/muokkaa.html');
      
  }
}

