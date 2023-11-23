<?php
class BD{
    public static $instancia=null;
    public static function crearInstancia(){
        if( !isset(self::$instancia) ){
            $opciones[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION;
             self::$instancia = new PDO('mysql:host=localhost;dbname=id21372793_delicious', 'id21372793_root', 'Mecos2.01110', $opciones);
        }
        return self::$instancia;
    }
}
?>
