<?php
class representation{
  
  private function _json($output){
      if(F3::get('REQUEST.callback')){
        header('Content-Type: application/javascript, charset=UTF-8');
        echo F3::get('REQUEST.callback').'('.json_encode($output,JSON_HEX_QUOT).')';
        return;
      }
      header('Content-Type: application/json, charset=UTF-8');
      echo json_encode($output);
  }
  
  private function _xml($output){
    
  }
  
  function render($output=null,$format){
    $format=$format?$format:'json';
    if(is_array($output)){
      if(!count(array_filter($output,function($item){return !empty($item);}))){
        $output=array();
        $output['error']=404;
      }
      if(isset($output['error'])&&is_int($output['error'])){
        $this->status($output['error']);
        $output['error']=constant('Base::HTTP_'.$output['error']);
      }
      else{
        $this->status(200);
      }
      if(is_callable(array($this,'_'.$format)))
        call_user_func(array($this,'_'.$format),$output);
    }
  }
  
  function status($code=null){
    if(!$code)
      $code=F3::get('ERROR.code');
    header('HTTP/1.1 '.$code);
  }
  
  function format($mapper,$format){
    $output=array();
    if(is_array($mapper)){
      foreach($mapper as $item){
        $output[]=array_map(function($elmt) use($item){
            if(preg_match_all('/(.+)?mapper\->(\w+)(.+)?/',$elmt,$catch))
              return $catch[1][0].$item->$catch[2][0].$catch[3][0]; 
         },$format);
      }
    }
    if(is_object($mapper)){
      $output=array_map(function($elmt) use($mapper){
          if(preg_match_all('/(.+)?mapper\->(\w+)(.+)?/',$elmt,$catch))
            return $catch[1][0].$mapper->$catch[2][0].$catch[3][0]; 
       },$format);
    }
    return $output;
   }
  
}
?>