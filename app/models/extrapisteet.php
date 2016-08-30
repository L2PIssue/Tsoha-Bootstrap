<?php

class Extrapisteet extends BaseModel {
    
    public $id, $kuvaus, $pisteet, $fuksiid, $tuutoriid, $tuutorinimi;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO extrapisteet (kuvaus, pisteet, fuksiid, tuutoriid) VALUES (:kuvaus, :pisteet, :fuksiid, :tuutoriid) RETURNING id');
        $query->execute(array('kuvaus' => $this->kuvaus, 'pisteet' => $this->pisteet, 'fuksiid' => $this->fuksiid, 'tuutoriid' => $this->tuutoriid));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function all($fuksiid) {
        $query = DB::connection()->prepare('SELECT * FROM Extrapisteet WHERE fuksiid = :fuksiid');
        $query->execute(array('fuksiid' => $fuksiid));
        $rows = $query->fetchAll();
        $pisteet = array();
        foreach ($rows as $row) {
            $pisteet[] = new Extrapisteet(array(
                'id' => $row['id'],
                'kuvaus' => $row['kuvaus'],
                'pisteet' => $row['pisteet'],
                'fuksiid' => $row['fuksiid'],
                'tuutoriid' => $row['tuutoriid'],
                'tuutorietunimi' => Kayttaja::find($row['tuutoriid'])->etunimi,
                'tuutorisukunimi' => Kayttaja::find($row['tuutoriid'])->sukunimi
            ));
        }
        return $pisteet;
        
    }
    
}