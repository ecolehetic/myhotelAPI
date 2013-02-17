<?php
class App_controller{
  
  function get(){
    echo Views::instance()->render('home.html');
  }
  
}
?>