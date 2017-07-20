<?php
ShopupApi_Autoloader::Register();
class ShopupApi_Autoloader {
    public static function Register() {
        return spl_autoload_register(array('ShopupApi_Autoloader','Load'));
    }
    public static function Load($pClassName) {
        if ((class_exists($pClassName,FALSE)) || (strpos($pClassName,'onamae') !== 0)) {
            return FALSE;
        }
        $pClassFilePath = 'apps/module/domains/'.str_replace('_',DIRECTORY_SEPARATOR,$pClassName).'.php';
        if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
            return FALSE;
        }
        require($pClassFilePath);
    }
}
?>