<?php
if(file_exists("/home/dotcloud/environment.json")){
  $env =  json_decode(file_get_contents("/home/dotcloud/environment.json"));
  $f3->set('db_login',$env->DOTCLOUD_DB_MYSQL_LOGIN);
  $f3->set('db_password',$env->DOTCLOUD_DB_MYSQL_PASSWORD); 
  $f3->set('db_host',$env->DOTCLOUD_DB_MYSQL_HOST);
  $f3->set('db_port',$env->DOTCLOUD_DB_MYSQL_PORT);
  $f3->set('db_server','');
}
else{
  $f3->set('db_login','root');
  $f3->set('db_password',''); 
  $f3->set('db_host','localhost');
  $f3->set('db_port','3306');
  $f3->set('db_server',''); 
}
?>