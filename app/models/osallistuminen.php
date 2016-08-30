<?php

class Osallistuminen extends BaseModel {
    
    public $id, $hyvaksytty, $tapahtumaid, $kayttajaid, $tapahtumanimi, $kayttajaetunimi, $kayttajasukunimi;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Osallistuminen (hyvaksytty, tapahtumaid, kayttajaid) VALUES (:hyvaksytty, :tapahtumaid, :kayttajaid) RETURNING id');
        $query->execute(array('hyvaksytty' => $this->hyvaksytty, 'tapahtumaid' => $this->tapahtumaid, 'kayttajaid' => $this->kayttajaid));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public static function hyvaksymatta(){
        $query = DB::connection()->prepare('SELECT Kayttaja.etunimi as etunimi, Kayttaja.sukunimi as sukunimi, Kayttaja.id as kayttajaid, Tapahtuma.nimi as tapahtumanimi, Tapahtuma.id as tapahtumaid, Osallistuminen.id, Osallistuminen.hyvaksytty FROM Kayttaja, Tapahtuma, Osallistuminen WHERE tapahtuma.id = osallistuminen.tapahtumaid AND kayttaja.id = osallistuminen.kayttajaid AND osallistuminen.hyvaksytty = false');
        $query->execute();
        $rows = $query->fetchAll();
        $hyvaksymatta = array();
        
        foreach($rows as $row){
            $hyvaksymatta[] = new Osallistuminen(array(
            'id' => $row['id'],
            'hyvaksytty' => $row['hyvaksytty'],
            'tapahtumaid' => $row['tapahtumaid'],
            'kayttajaid' => $row['kayttajaid'],
            'tapahtumanimi' => $row['tapahtumanimi'],
            'kayttajaetunimi' => $row['etunimi'],
            'kayttajasukunimi' => $row['sukunimi'],    
            ));
        }

        return $hyvaksymatta;
    }
    
    public function kayttajan($id){
        $query = DB::connection()->prepare('SELECT * FROM Osallistuminen WHERE kayttajaid = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $o = array();
        
        foreach($rows as $row){
            $o[] = new Osallistuminen(array(
            'id' => $row['id'],
            'hyvaksytty' => $row['hyvaksytty'],
            'tapahtumaid' => $row['tapahtumaid'],
            'kayttajaid' => $row['kayttajaid']   
            ));
        }

        return $o;
    }
    
    public function hyvaksy() {
        $query = DB::connection()->prepare('UPDATE Osallistuminen SET hyvaksytty = true WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Osallistuminen WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }
    
}