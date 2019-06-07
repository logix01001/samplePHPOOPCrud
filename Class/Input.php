<?php


class Input {
	

    public static function exist($type = 'post'){

        switch ($type) {
            case 'post':
                # code...
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                # code...
                if(isset($_GET)){
                    return (!empty($_GET)) ? true : false;
                }
                break;
            default:
                # code...
                return false;
                break;
        }

    }

    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        }else if(isset($_GET[$item])){
            return $_GET[$item];
        }
        else{
            return '';
        }
    }


	
}