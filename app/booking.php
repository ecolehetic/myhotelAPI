<?php
class booking{

  private $output;
  private $rep;
  private $dB;
  private $account;
  
  function __construct(){
    $this->dB = new DB\SQL('mysql:host='.F3::get('db_host').';port='.F3::get('db_port').';dbname='.F3::get('db_server'),F3::get('db_login'),F3::get('db_password'));
    $this->rep = new representation();
    $this->output=array();
  }
  
  function beforeroute(){
    $this->account=F3::get('GET.account');
    if(!$this->account){
      $this->output['error']=400;
      $this->afterroute();
      return false;
    }
  }

  function get(){
    $id=F3::get('PARAMS.id');
    if($id){
      $booking=new DB\SQL\Mapper($this->dB,'booking');
      $mapper=$booking->load(array('idAccount=? and id=?',$this->account,$id));
      if(!$mapper){
        return;
      }
      $this->output['booking'] = $this->rep->format($mapper,array('pax'=>'mapper->pax','date'=>'mapper->date','checkIn'=>'mapper->checkIn','checkOut'=>'mapper->checkOut'));
      
      $rooms=new DB\SQL\Mapper($this->dB,'rooms');
      $mapper=$rooms->load(array('id=?',$mapper->idRooms));
      $this->output['rooms'] = $this->rep->format($mapper,array('url'=>'/rooms/mapper->id','name'=>'mapper->name','maxPax'=>'mapper->pax'));
    }
    else{
      $bookings=new DB\SQL\Mapper($this->dB,'booking');
      $mapper=$bookings->find(array('idAccount=?',$this->account),array('order'=>'date DESC'));
      $this->output['booking'] = $this->rep->format($mapper,array('url'=>'booking/mapper->id','date'=>'mapper->date'));
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
