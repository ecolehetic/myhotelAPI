<?php
class App extends Prefab {
  
  
  
  function __construct(){
    F3::set('dB',new DB\SQL('mysql:host='.F3::get('db_host').';port='.F3::get('db_port').';dbname='.F3::get('db_server'),F3::get('db_login'),F3::get('db_password')));
  }
  
  
  function getMenu(){
    $menu=new DB\SQL\Mapper(F3::get('dB'),'page');
    return $menu->find();
  }
  
  function getPage($slug){
    $page=new DB\SQL\Mapper(F3::get('dB'),'page');
    return $page->load(array('slug=?',$slug));
  }
  
  function getContent($idPage){
    $content=new DB\SQL\Mapper(F3::get('dB'),'content');
    return $content->find(array('idPage=?',$idPage));
  }

  
  
  
}
?>