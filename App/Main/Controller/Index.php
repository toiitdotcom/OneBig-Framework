<?php

if (!defined('BASEPATH'))
    exit('Fuck.Plz, contact nhatnv - skype: nhat.89');

Class Index extends Autoload {

    public function __construct() {
        parent::__construct();
        $this->Mindex = $this->model('Mindex');
        $this->data['controller'] = 'index';
    }
    
    
    public function index()
    {
        die('index');
    }
    
}
