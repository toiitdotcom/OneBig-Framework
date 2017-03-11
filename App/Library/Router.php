<?php

if (!defined('BASEPATH'))
    exit('Fuck.Plz, contact nhatnv - skype: nhat.89');

Class Router extends Config{

    //public $_lib;

    public function __construct() {
        //$this->_lib = new Lib();
    }
    
    public function run($RunApp) {
        $RunApp->runApplication();
    }

}
