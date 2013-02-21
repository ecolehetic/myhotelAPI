<?php
class hotels{

  private $output;
  private $rep;
  private $dB;
  
  function __construct(){
    $this->output=array();
    $this->rep = new representation();
    $this->dB = new DB\SQL('mysql:host='.F3::get('db_host').';port='.F3::get('db_port').';dbname='.F3::get('db_server'),F3::get('db_login'),F3::get('db_password'));
  }
  

  function get(){
    $id=F3::get('PARAMS.id');
    $hotels=new DB\SQL\Mapper($this->dB,'hotels');
    
    if($id){
      $mapper=$hotels->load(array('id=?',$id));
      $this->output['hotels'] = $this->rep->format($mapper,array('url'=>'/hotels/mapper->id','name'=>'mapper->name','address'=>'mapper->address','lat'=>'mapper->lat','lng'=>'mapper->lng'));
      
      $rooms=new DB\SQL\Mapper($this->dB,'rooms');
      $mapper=$rooms->find(array('idHotels=?',$id));
      $this->output['rooms'] = $this->rep->format($mapper,array('url'=>'/rooms/mapper->id','name'=>'mapper->name','maxPax'=>'mapper->pax'));
    }
    else{
      $search=F3::get('GET.name')?array('name like "%'.F3::get('GET.name').'%"'):array();
      
      $mapper=$hotels->find($search);
      $this->output['hotels'] = $this->rep->format($mapper,array('url'=>'/hotels/mapper->id','name'=>'mapper->name','address'=>'mapper->address','lat'=>'mapper->lat','lng'=>'mapper->lng'));
    }
     
  }
  function post(){
    $this->output['error']=403;    
  }
  
  function put(){
    $this->output['error']=403;
  }
  
  function delete(){
    $this->output['error']=403;
  }
  
  function afterroute(){
    $this->rep->render($this->output,F3::get('REQUEST.format'));
  }
  
  
}
?>
