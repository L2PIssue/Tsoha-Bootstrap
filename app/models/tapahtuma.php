<?php

class Tapahtuma extends BaseModel {
    
    public $id, $nimi, $kuvaus, $paikka, $pvm, $aika, $pisteet;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_pisteet');
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tapahtuma (nimi, kuvaus, paikka, pvm, aika, pisteet) VALUES (:nimi, :kuvaus, :paikka, :pvm, :aika, :pisteet) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'paikka' => $this->paikka, 'pvm' => $this->pvm, 'aika' => $this->aika, 'pisteet' => $this->pisteet));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tapahtuma');
        $query->execute();
        $rows = $query->fetchAll();
        $tapahtumat = array();
        foreach ($rows as $row) {
            $tapahtumat[] = new Tapahtuma(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus'],
                'paikka' => $row['paikka'],
                'pvm' => $row['pvm'],
                'aika' => $row['aika'],
                'pisteet' => $row['pisteet']
            ));
        }
        return $tapahtumat;
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
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE tapahtuma SET nimi = :nimi, kuvaus = :kuvaus, paikka = :paikka, aika = :aika, pisteet = :pisteet, pvm = :pvm WHERE id=:id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'paikka' => $this->paikka, 'pvm' => $this->pvm, 'pisteet' => $this->pisteet, 'aika' => $this->aika, 'id' => $this->id));
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tapahtuma WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }
    
    public function validate_nimi(){
        $errors = array();
        if($this->nimi == '' || $this->nimi == null){
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        return $errors;
    }
    
    public function validate_pisteet(){
        $errors = array();
        if($this->pisteet == '' || $this->pisteet == null){
            $errors[] = 'Tapahtumasta täytyy saada pisteitä!';
        }
        return $errors;
    }

}

