<?php

if (!defined('BASEPATH'))
    exit('Fuck.Plz, contact nhatnv - skype: nhat.89');


Class RunApp extends Autoload {

    public $_lib;
    public function __construct() {
        $this->_lib = new Lib();
    }

    public function runApplication() {
        $this->_lib->controller($this->_lib->getParamString('action'));
    }
}
