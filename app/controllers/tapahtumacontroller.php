<?php

class TapahtumaController extends BaseController{
  public static function index(){
    $tapahtumat = Tapahtuma::all();
    View::make('tapahtuma/index.html', array('tapahtumat' => $tapahtumat));
  }
}
