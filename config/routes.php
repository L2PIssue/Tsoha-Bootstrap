<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/fuksit', function() {
      KayttajaController::fuksit();
  });
  
  $routes->get('/tapahtumat', function() {
    HelloWorldController::tapahtumat();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
