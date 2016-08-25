<?php

class Tapahtuma extends BaseModel {
    
    public $id, $nimi, $kuvaus, $paikka, $aika, $pisteet;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
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
                'aika' => $row['aika'],
                'pisteet' => $row['pisteet']
            ));
        }
        return $tapahtumat;
    }

}

