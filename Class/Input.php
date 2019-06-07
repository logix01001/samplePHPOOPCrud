<?php


class Input {
	
	public static function Exist($request){
		
		if(isset($_POST[$request]) || isset($_GET[$request]){
			
			return true;
			
		}else{
			return false;
		}
		
	}
	
	public static function get($request){
		
		
		if(isset($_POST[$request])){
			
			return $_POST[$request];
			
		}
		else if(isset($_GET[$request])){
			return $_GET[$request];
		}else{
			
			return '';
		}
		
	}
	
	
}