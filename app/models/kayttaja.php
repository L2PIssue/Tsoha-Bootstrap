<?php

class Kayttaja extends BaseModel {
    
    public $id, $nimimerkki, $etunimi, $sukunimi, $salasana, $tuutori, $admin;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $kayttajat = array();

        // Käydään kyselyn tuottamat rivit läpi
        foreach($rows as $row){
        // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
        $kayttajat[] = new Kayttaja(array(
        'id' => $row['id'],
        'nimimerkki' => $row['nimimerkki'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'salasana' => $row['salasana'],
        'tuutori' => $row['tuutori'],
        'admin' => $row['admin']
      ));
    }

    return $kayttajat;
  }
  
  public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimimerkki' => $row['nimimerkki'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'tuutori' => $row['tuutori'],
                'admin' => $row['admin']
            ));
            return $kayttaja;
        }
        return null;
    }
  
}


