<?php

if (!defined('BASEPATH'))
    exit('Fuck.Plz, contact nhatnv - skype: nhat.89');

/**
 * 
 * @void Load Database
 * 
 */
require_once(BASEPATH . '/App/DB/Database.php');

/**
 * 
 * @void Load Các Config
 * 
 */
require_once(BASEPATH . '/App/Config/Config.php');

/**
 * @void load Class Name in Component
 */
$config = new Config();
$_loadClassComponent = $config->_loadClassComponent;

/**
 * 
 * @void Load Lib
 * 
 */
require_once(BASEPATH . '/App/Library/Lib.php');
/**
 * 
 * @void Load Các Router
 * 
 */
require_once(BASEPATH . '/App/Library/Router.php');


/**
 * 
 * @void Load Router
 * 
 */
$Router = new Router();

/**
 * 
 * @void Load Autoload
 * 
 */

Class Autoload extends Lib {
    public function __construct() {
        if(USEDB == 'yes')
        {
            $this->db = new Database();
        }  
    }

}
