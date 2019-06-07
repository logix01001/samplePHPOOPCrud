<?php

session_start();


$GLOBALS['config'] = array(
  'mysql' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'password'=> 'lynadmin',
      'db' => 'pizza_order'
  )
);

spl_autoload_register(function($class){
	
	require_once 'class/' . $class . ".php";
	
});