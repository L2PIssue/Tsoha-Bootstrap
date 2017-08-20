<?php

  // Laitetaan virheilmoitukset näkymään
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  // Selvitetään, missä kansiossa index.php on
  // $script_name = $_SERVER['SCRIPT_NAME'];
  // $explode =  explode('/', $script_name);

  // if($explode[1] == 'index.php'){
  //   $base_folder = '';
  // }else{
  //   $base_folder = $explode[1];
  // }

  // Määritetään sovelluksen juuripolulle vakio BASE_PATH
  define('BASE_PATH', '/' . 'index.php');

  // Luodaan uusi tai palautetaan olemassaoleva sessio
  if(session_id() == '') {
    session_start();
  }

  $dbopts = parse_url(getenv('postgres://eehitjztgpulmg:175256241b51a2eac305ca0c23a8ad52902b29e086ab599b9b10f3a430d17cf3@ec2-54-75-249-162.eu-west-1.compute.amazonaws.com:5432/d5i3ppiq65bhro'));
  $app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["eehitjztgpulmg"],
                   'password' => $dbopts["175256241b51a2eac305ca0c23a8ad52902b29e086ab599b9b10f3a430d17cf3"],
                   'host' => $dbopts["ec2-54-75-249-162.eu-west-1.compute.amazonaws.com"],
                   'port' => $dbopts["5432"],
                   'dbname' => ltrim($dbopts["d5i3ppiq65bhro"],'/')
                   )
               )
  );


  // Asetetaan vastauksen Content-Type-otsake, jotta ääkköset näkyvät normaalisti
  header('Content-Type: text/html; charset=utf-8');

  // Otetaan Composer käyttöön
  require 'vendor/autoload.php';

  $routes = new \Slim\Slim();
  //$routes->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

  $routes->get('/tietokantayhteys', function(){
    DB::test_connection();
  });

  // Otetaan reitit käyttöön
  require 'config/routes.php';

  $routes->run();
