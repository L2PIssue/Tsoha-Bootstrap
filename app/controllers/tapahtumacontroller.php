<?php

class TapahtumaController extends BaseController{
    
  public static function index(){
    $tapahtumat = Tapahtuma::all();
    $osallistumiset = Osallistuminen::kayttajan(BaseController::get_user_logged_in()->id);
    $oss = array();
        foreach ($osallistumiset as $o) {
            $oss[] = $o->tapahtumaid;
        }
        
    View::make('tapahtuma/list.html', array('tapahtumat' => $tapahtumat), array('oss' => $oss));
  }
  
  public static function create() {
      View::make('tapahtuma/uusi.html');
      
  }
  
  public static function store() {
      $params = $_POST;
      $aika = null;
      $pvm = null;
      if ($params['aika'] != "") {
          $aika = $params['aika'];
      }
      if ($params['aika'] != "") {
          $pvm = $params['pvm'];
      }
      
            $tapahtuma = new Tapahtuma(array(
                  'nimi' => $params['nimi'],
                  'kuvaus' => $params['kuvaus'],
                  'pvm' => $pvm,
                  'aika' => $aika,
                  'paikka' => $params['paikka'],
                  'pisteet' => $params['pisteet']
            ));
      
    
    $errors = $tapahtuma->errors();
    if (count($errors) == 0) {
        $tapahtuma->save();
        Redirect::to('/tapahtumat/' . $tapahtuma->id);
    } else {
        View::make('tapahtuma/uusi.html', array('errors' => $errors, 'tapahtuma' => $tapahtuma));
    }
    
  }
  
  public static function show($id) {
      $tapahtuma = Tapahtuma::find($id);
      View::make('tapahtuma/show.html', array('tapahtuma' => $tapahtuma));
      
  }
  
  public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tapahtuma WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $tapahtuma = new Tapahtuma(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus'],
                'paikka' => $row['paikka'],
                'aika' => $row['aika'],
                'pisteet' => $row['pisteet'],
                'pvm' => $row['pvm']
            ));
            return $tapahtuma;
        }
        return null;
    }
  
  public static function edit($id) {
      $tapahtuma = Tapahtuma::find($id);
      View::make('tapahtuma/muokkaa.html', array('tapahtuma' => $tapahtuma));
      
  }
  
  
  public static function update($id) {
      $params = $_POST;
      
    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'kuvaus' => $params['kuvaus'],
      'pvm' => $params['pvm'],
      'aika' => $params['aika'],
      'paikka' => $params['paikka'],
      'pisteet' => $params['pisteet']
    );
    $tapahtuma = new Tapahtuma($attributes);
    $errors = $tapahtuma->errors();
    
    if (count($errors) == 0) {
        $tapahtuma->update();
        Redirect::to('/tapahtumat/' . $tapahtuma->id);
    } else {
        View::make('tapahtuma/muokkaa.html', array('errors' => $errors));
    }
    
  }
  
  public static function destroy($id) {
      $tapahtuma = new Tapahtuma(array('id' => $id));
      $tapahtuma->destroy();
      Redirect::to('/tapahtumat');
  }
  
}
