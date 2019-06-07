<?php

class Session {

    public static function exist($key){
        return (isset($_SESSION[$key])) ? true : false;
    }


    public static function put($key,$value){
        return $_SESSION[$key] = $value;
    }


    public static function get($key = null){
        if($key == null){
            return $_SESSION;
        }else{
            return (self::exist($key)) ? $_SESSION[$key] : '';
        }
       
    }

   
    
    public static function delete($key){
        if(self::exists($key)){
            unset($_SESSION[$key]);
        }
    }


    public static function destroy(){
       session_destroy();
    }

   

 

}