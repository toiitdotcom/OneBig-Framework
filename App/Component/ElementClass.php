<?php

/**
 * 
 * @void Load Các Function
 * 
 */
foreach ($_loadClassComponent as $key => $value) {
    require_once(BASEPATH . '/App/Component/Class/' . $value . '.php');
}

Class ElementClass extends Config {
    
    public function __call($method, $args) {
        $exp = explode('__', $method);
        $run = new $exp[0]();
        return $run->$exp[1]($args);
    }
}
