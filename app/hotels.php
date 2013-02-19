<?php
class hotels{
  
  private $hotels;
  public $output;
  
  function __construct(){
    F3::set('dB',new DB\SQL('mysql:host='.F3::get('db_host').';port=3306;dbname='.F3::get('db_server'),F3::get('db_login'),F3::get('db_password')));
    $this->hotels=new DB\SQL\Mapper(F3::get('dB'),'hotels');
  }

  function get(){
    $id=F3::get('PARAMS.id');
    $req=$id?array('id=?',$id):'';
    if(!$this->output=$this->hotels->find($req)){
      F3::error(403);
      return
    }
  }
  
  function afterroute(){
    echo Views::instance()->toJSON($this->output,array());
  }
  
}
?>
