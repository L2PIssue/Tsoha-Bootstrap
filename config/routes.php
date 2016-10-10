<?php

function check_logged_in(){
  BaseController::check_logged_in();
}

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/login', function(){
    KayttajaController::login();
  });
  
  $routes->post('/login', function(){
    KayttajaController::handle_login();
  });
  
  $routes->post('/logout', function(){
    KayttajaController::logout();
  });
  
  $routes->get('/kayttajat', 'check_logged_in', function() {
      KayttajaController::index();
  });
  
  $routes->post('/kayttaja/tuutoroi/:id', 'check_logged_in', function($id) {
      KayttajaController::tuutoroi($id);
  });
  
  $routes->get('/register', function() {
      KayttajaController::register();
  });
  
  $routes->post('/register', function() {
      KayttajaController::handle_registeration();
  });
  
  $routes->get('/kayttaja/:id', 'check_logged_in', function($id) {
      KayttajaController::show($id);
  });
  
  $routes->get('/kayttaja/:id/muokkaa', 'check_logged_in', function($id) {
      KayttajaController::edit($id);
  });
  
  $routes->post('/kayttaja/:id/muokkaa', 'check_logged_in', function($id) {
      KayttajaController::update($id);
  });
  
  $routes->post('/kayttaja/:id/destroy', 'check_logged_in', function($id) {
      KayttajaController::destroy($id);
  });
  
  $routes->get('/tapahtumat', 'check_logged_in', function() {
      TapahtumaController::index();
  });
  
  $routes->post('/tapahtumat', 'check_logged_in', function() {
      TapahtumaController::store(); 
  });
  
  $routes->get('/tapahtumat/uusi', 'check_logged_in', function() {
      TapahtumaController::create();
  });
  
  $routes->get('/tapahtumat/:id', 'check_logged_in', function($id) {
      TapahtumaController::show($id);
  });
  
  $routes->get('/tapahtumat/:id/muokkaa', 'check_logged_in', function($id) {
      TapahtumaController::edit($id);
  });
  
  $routes->post('/tapahtumat/:id/muokkaa', 'check_logged_in', function($id) {
      TapahtumaController::update($id);
  });
  
  $routes->post('/tapahtumat/:id/destroy', 'check_logged_in', function($id) {
      TapahtumaController::destroy($id);
  });
  
  $routes->post('/tapahtumat/:id/osallistu', 'check_logged_in', function() {
    OsallistumisController::store();
  });
  
  $routes->post('/hyvaksy/:id', 'check_logged_in', function($id) {
      OsallistumisController::hyvaksy($id);
  });
  
  $routes->post('/hylkaa/:id', 'check_logged_in', function($id) {
      OsallistumisController::destroy($id);
  });

