<?php

class Config {
	
	
	public static function get($path){
		
		$config = $GLOBALS['config'];
		$paths = explode('/',$path);
		
		foreach($paths as $path){
			
			if(isset($config[$path])){
				
				$config = $config[$path];
				
			}
			
			
			
		}
		
		return $config;
		
		
	}
	
	
}