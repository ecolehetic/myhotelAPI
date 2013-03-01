<?php
class mongodB{

  private $dB;
  private $hotels;
  
  function __construct(){
    $this->dB = new DB\Mongo('mongodb://localhost:27017','hotelapi');
    $this->hotels=new DB\Mongo\Mapper($this->dB,'hotels');
  }
  

  function create(){
    $this->hotels->name='Hôtel du Nord';
    $this->hotels->address='102 Quai de Jemmapes, 75010 Paris, France';
    $this->hotels->lat=48.873579;
    $this->hotels->lng=2.364292;
    $this->hotels->save();
  }
  
  function update(){
    $id=F3::get('PARAMS.id');
    if($this->hotels->load(array('_id'=>new MongoId($id)))){
      $this->hotels->address='new address';
      $this->hotels->rooms=array(
        array('name'=>'supérieur double','pax'=>2),
        array('name'=>'supérieur single','pax'=>1),
        array('name'=>'suite deluxe','pax'=>3)
      );
      $this->hotels->save();
  }
  
  function research(){
    if($id=F3::get('PARAMS.id')){
      $mapper=$this->hotels->load(array('_id'=>new MongoID($id)));
      echo json_encode($mapper);
    }
    else{
      $search=F3::exists('GET.name')?array('name'=>new MongoRegex('/'.F3::get('GET.name').'/i')):array();
      $mapper=$this->hotels->find($search);
      echo json_encode($mapper);
    }
    
  }
    
  
      
        
  }
     
}
?>
