<?php

class OsallistumisController extends BaseController {
    
    public static function store() {
        $params = $_POST;
        
        $kayttajan = Osallistuminen::kayttajan($params['kayttajaid']);
        
        foreach ($kayttajan as $k) {
            if ($k->kayttajaid == $params['kayttajaid'] && $k->tapahtumaid == $params['tapahtumaid']) {
                Redirect::to('/tapahtumat', array('errors' => array('Olet jo osallistunut')));
            }
        }

        $osallistuminen = new Osallistuminen(array(
          'hyvaksytty' => 0,
          'tapahtumaid' => $params['tapahtumaid'],
          'kayttajaid' => $params['kayttajaid']
        ));

        $osallistuminen->save();
        Redirect::to('/tapahtumat');
    }
    
    public static function destroy($id) {
      $o = new Osallistuminen(array('id' => $id));
      $o->destroy();
      Redirect::to('/');
    }
  
    public static function hyvaksy($id) {
      $o = new Osallistuminen(array('id' => $id));
      $o->hyvaksy();
      Redirect::to('/');
    }
    
    
}
