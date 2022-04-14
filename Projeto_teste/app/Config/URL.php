<?php
#1.0.1
class Encripty{
    public static function encript($value){
        return hash('sha1', $value);
    }
}
class URL {    
	  const encode = 'encode';
	  const decode = 'decode';
	  const controllers = 'controllers';
	  const models = 'models';
    
    /*
	  Option
    */
    static function option($name, $option = URL::encode){
        switch ($option){
            case URL::encode:     return Encripty::encript($name);
            case URL::decode:     return Encripty::encript($name);
            case URL::controllers:return Config::Controllers.$name.'.php';
            case URL::models:     return Config::Models.$name.'.php';
            default:              return Encripty::encript($name);
       }
    }
    
    /*
	  login
    */
    public static function login($option = URL::encode){
        return URL::option(__FUNCTION__, $option);
    }
    /*
	  principal
    */
    public static function principal($option = URL::encode){
        return URL::option(__FUNCTION__, $option);
    }
    /*
	FUNCIONARIO
    */
    public static function funcionario($option = URL::encode){
        return URL::option(__FUNCTION__, $option);
    }
}
?>
