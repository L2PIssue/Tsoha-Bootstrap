<?php

class Kayttaja extends BaseModel {
    
    public $id, $nimimerkki, $etunimi, $sukunimi, $salasana, $tuutori, $admin, $pisteet;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_nick', 'validate_salasana');
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO kayttaja (nimimerkki, etunimi, sukunimi, salasana, tuutori, admin) VALUES (:nimimerkki, :etunimi, :sukunimi, :salasana, :tuutori, :admin) RETURNING id');
        $query->execute(array('nimimerkki' => $this->nimimerkki, 'salasana' => $this->salasana, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'tuutori' => $this->tuutori, 'admin' => $this->admin));
        $row = $query->fetch();
        $this->id = $row['id'];
  }
  
    public static function authenticate($nimimerkki, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM kayttaja WHERE nimimerkki = :nimimerkki AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimimerkki' => $nimimerkki, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimimerkki' => $row['nimimerkki'],
                'salasana' => $row['salasana'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'tuutori' => $row['tuutori'],
                'admin' => $row['admin']
            ));
            return $kayttaja;
        } else {
            return null;
        }
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kayttajat = array();

        foreach($rows as $row){
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
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
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
    
    public function tuutoroi() {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET tuutori = true WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }
    
    public function getPisteet() {
        $query = DB::connection()->prepare('SELECT Kayttaja.id AS kid, Osallistuminen.id AS oid, Tapahtuma.id AS tid, Tapahtuma.pisteet AS pisteet FROM Kayttaja, Tapahtuma, Osallistuminen WHERE tapahtuma.id = osallistuminen.tapahtumaid AND kayttaja.id = osallistuminen.kayttajaid AND osallistuminen.hyvaksytty = true');
        $query->execute();
        $rows = $query->fetchAll();
        $pisteet = 0;
        foreach ($rows as $row) {
            $pisteet += $row['pisteet'];
        }
        return $pisteet;
    }
    
    public function getExtraPisteet() {
        $query = DB::connection()->prepare('SELECT * FROM Extrapisteet WHERE fuksiid=:id');
        $query->execute();
        $rows = $query->fetchAll();
        $pisteet = array();
        foreach ($rows as $row) {
            $pisteet[] = new Extrapisteet(array(
                'id' => $row['id'],
                'kuvaus' => $row['kuvaus'],
                'pisteet' => $row['pisteet'],
                'fuksiid' => $row['fuksiid'],
                'tuutoriid' => $row['tuutoriid']
            ));
        }
        return $pisteet;
    }
    
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET nimimerkki = :nimimerkki, etunimi = :etunimi, sukunimi = :sukunimi WHERE id=:id');
        $query->execute(array('nimimerkki' => $this->nimimerkki, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'id' => $this->id));
    }
    
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }
    
    public function validate_nimi(){
        $errors = array();
        if($this->etunimi == '' || $this->etunimi == null){
            $errors[] = 'Etunimi ei saa olla tyhjä!';
        }
        if($this->sukunimi == '' || $this->sukunimi == null){
            $errors[] = 'Sukunimi ei saa olla tyhjä!';
        }
        return $errors;
    }
  
    public function validate_nick(){
        $errors = array();
        if($this->nimimerkki == '' || $this->nimimerkki == null){
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä!';
        }
        return $errors;
    }
    
    public function validate_salasana(){
        $errors = array();
        if($this->salasana == '' || $this->salasana == null){
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        
        return $errors;
    }
}



