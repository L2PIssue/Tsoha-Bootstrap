<?php

class KayttajaController extends BaseController{
  public static function index() {
    $kayttajat = Kayttaja::All();
    $pisteet = Kayttaja::getPisteet();
    View::make('kayttaja/list.html', array('kayttajat' => $kayttajat, 'pisteet' => $pisteet));
        
  }
  
  public static function register() {
    View::make('kayttaja/register.html');
      
  }
  
  public static function handle_registeration() {
        
        $params = $_POST;
        $kayttajat = Kayttaja::all();
        
        
        $attributes = array(
            'nimimerkki' => $params['nimimerkki'],
            'etunimi' => $params['etunimi'],
            'sukunimi' => $params['sukunimi'],
            'salasana' => $params['salasana'],
            'tuutori' => 0,
            'admin' => 0
        );
        foreach ($kayttajat as $k) {
            if ($params['nimimerkki'] == $k->nimimerkki) {
                Redirect::to('/register', array('errors' => array('Nimimerkki on jo käytössä'), 'attributes' => $attributes));
            }
        }
        if ($params['salasana'] != $params['varmistus']) {
            Redirect::to('/register', array('errors' => array('Salasanat eivät vastanneet toisiaan.'), 'attributes' => $attributes));
        }
        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->save();
            Redirect::to('/login', array('message' => 'Rekisteröinti onnistui!'));
        } else {
            View::make('kayttaja/register.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
  
  public static function login(){
      View::make('kayttaja/login.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $kayttaja = Kayttaja::authenticate($params['nimimerkki'], $params['salasana']);

    if(!$kayttaja){
      View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimimerkki' => $params['nimimerkki']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;

      Redirect::to('/', array('message' => 'Tervetuloa' . $kayttaja->etunimi . '!'));
    }
  }
  
  public static function logout(){
    $_SESSION['kayttaja'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }
  
  
  public static function show($id) {
      $kayttaja = Kayttaja::find($id);
      $pisteet = Extrapisteet::all($id);
      View::make('kayttaja/show.html', array('kayttaja' => $kayttaja, 'pisteet' => $pisteet));
      
  }
  
  public static function edit($id) {
      $kayttaja = Kayttaja::find($id);
      View::make('kayttaja/muokkaa.html', array('kayttaja' => $kayttaja));
      
  }
  
  public static function update($id) {
    $params = $_POST;
      
    $attributes = array(
        'id' => $id,
        'nimimerkki' => $params['nimimerkki'],
        'etunimi' => $params['etunimi'],
        'sukunimi' => $params['sukunimi'],
        'salasana' => Kayttaja::find($id)->salasana
    );
    $kayttaja = new Kayttaja($attributes);
    $errors = $kayttaja->errors();
    
    if (count($errors) == 0) {
        $kayttaja->update();
        Redirect::to('/kayttaja/' . $kayttaja->id);
    } else {
        View::make('kayttaja/muokkaa.html', array('errors' => $errors, 'kayttaja' => $kayttaja));
    }
    
  }
  
  
  public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tapahtuma WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimimerkki' => $row['nimimerkki'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'salasana' => $row['salasana']
            ));
            return $kayttaja;
        }
        return null;
    }
  
    public static function tuutoroi($id) {
        $k = new Kayttaja(array('id' => $id));
        $k->tuutoroi();
        Redirect::to('kayttaja/show.html', array('kayttaja' => $k));
    }
    
    
    public static function getPisteet($id) {
        $k = new Kayttaja(array('id' => $id));
        $k->getPisteet();
    }
    
    public static function getExtraPisteet($id) {
        $k = new Kayttaja(array('id' => $id));
        $k->getExtraPisteet();
    }
    
    public static function destroy($id) {
      $k = new Kayttaja(array('id' => $id));
      $k->destroy();
      Redirect::to('/kayttajat');
    }
    
    
  
}

