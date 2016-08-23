<?php

use Kayttaja;

class KayttajaController extends BaseController{
  public static function fuksit(){
    $kayttajat = Kayttaja::all();
    View::make('fuksit.html', array('kayttajat' => $kayttajat));
  }
}

