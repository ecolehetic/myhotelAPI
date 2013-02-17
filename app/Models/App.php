<?php
class App extends Prefab{
  
  private $dB;
  
  function __construct(){
    $this->dB=new DB\SQL('mysql:host='.F3::get('db_host').';port='.F3::get('db_port').';dbname='.F3::get('db_server'),F3::get('db_login'),F3::get('db_password'));
  }

  
  
}
?>