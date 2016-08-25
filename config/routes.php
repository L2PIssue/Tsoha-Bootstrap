<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/kayttajat', function() {
      KayttajaController::index();
  });
  
  $routes->get('/kayttaja/show', function() {
      KayttajaController::show();
  });
  
  $routes->get('/kayttaja/muokkaa', function() {
      KayttajaController::edit();
  });
  
  $routes->get('/tapahtumat', function() {
      TapahtumaController::index();
  });
  
  $routes->get('/tapahtumat/show', function() {
      TapahtumaController::show();
  });
  
  $routes->get('/tapahtumat/muokkaa', function() {
      TapahtumaController::edit();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
