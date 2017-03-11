<?php

if (!defined('BASEPATH'))
    exit('Fuck.Plz, contact nhatnv - skype: nhat.89');
/**
 * 
 * @void Load Các Element Class
 * 
 */
require_once(BASEPATH . '/App/Component/ElementClass.php');

Class Lib extends ElementClass {

    public $db = array();
    public function __construct() {

    }
    
    public function getConstant($str)
    {
        return $str;
    }

    public function sctdata($string)
    {
        return addslashes(htmlentities($string));
    }
    
    public function rplUri($var) {
        $vowels = array("-", " -", "- ", "“", "”", "   ", "  ", "    ", " ", "/", '\"', "\'", "+", "=", "{", "}", ")", "(", "!", "`", "'", "~", "@", "#", "$", "%", "^", "&", "*", "_", "!", "!", ".", ",", ";", ":", "]", "[", "/");
        $rc = strtolower(str_replace($vowels, '-', rtrim(ltrim(str_replace(array('?', 'quot'), '', $var)))));
        return preg_replace('/--+/', '-', $rc);
    }
    
    public function get_ascii($st) {

        $vietChar = 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
        $engChar = 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';

        $arrVietChar = explode("|", $vietChar);
        $arrEngChar = explode("|", $engChar);
        $ftc = strtolower(str_replace($arrVietChar, $arrEngChar, (string) $st));
        $ftc_ = str_replace($arrVietChar, $arrEngChar, $ftc);
        $vowels = array("-", " -", "- ", " ", "/", "+", "=", "{", "}", ")", "(", "!", "`", "'", "~", "@", "#", "$", "%", "^", "&", "*", "_", "!", "!", ".", ",", ";", ":", "]", "[", "/");
        $dtr = str_replace($vowels, ' ', $ftc_);

        $vowels_ = array('\"');
        return $this->get_slug(str_replace($vowels_, ' ', $dtr));
    }

    private function get_slug($st) {
        $Char = '̀|̣|̉|́|̃|:|.|,|?|!|"|&quot;|;|{|}|(|)|《 | 》|《|》';
        $explChar = explode("|", $Char);
        return strtolower(str_replace($explChar, '', $st));
    }
    
    public function curl($url, $data = '') {
        if(!isset($url))
        {
            die('Vui lòng thêm vào url');
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/48.0.2564.82 Chrome/48.0.2564.82 Safari/537.36");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    
    public function Encode($m) {
        $m = base64_encode($m);
        $m = str_replace("Ax", "@jkp", $m);
        $m = str_replace("ak", "@bfg", $m);
        $m = str_replace("R", "!BeF", $m);
        return $m;
    }

    public function Decode($m) {
        $m = str_replace("!BeF", "R", $m);
        $m = str_replace("@bfg", "ak", $m);
        $m = str_replace("@jkp", "Ax", $m);
        $m = base64_decode($m);
        return $m;
    }

    public function set_userdata($param) {
        /**
         * @void Security SESSION
         */
        @session_regenerate_id();
        ini_set('session.cookie_httponly', true);
        /**
         * @void END Security SESSION 
         */
        foreach ($param as $key => $value) {
            $_SESSION[$key] = $value;
        }
        return true;
    }

    public function userdata($param) {
        return isset($_SESSION[$param]) ? $_SESSION[$param] : 'null';
    }

    public function view($tmp, $data) {
        return require_once(BASEPATH . '/App/Main/View/' . $tmp . '.php');
    }

    public function model($model) {
        require_once(BASEPATH . '/App/Main/Model/' . ucfirst($model) . '.php');
        return new $model();
    }

    public function controller($tmp) {

        @$exp = explode('_', $tmp);

        if (isset($exp[1])) {
            $action = ucfirst($exp[1]);
        } else {
            $action = 'Index';
        }
        if (isset($exp[0])) {
            $controller = ucfirst($exp[0]);
        } else {
            $controller = 'Index';
        }

        require_once(BASEPATH . '/App/Main/Controller/' . ($controller ? $controller : "Index") . '.php');
        @$run = new $controller();
        return $run->$action();
    }

    public function getParamString($param) {
        return addslashes(isset($_REQUEST[$param]) ? $_REQUEST[$param] : '');
    }

    public function getParamInt($param) {
        return intval(isset($_REQUEST[$param]) ? $_REQUEST[$param] : '');
    }

    public function full_url() {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
    }

    public function site_url() {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
        $exp = explode('?', $_SERVER['REQUEST_URI']);
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $exp[0];
    }

    public function getip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private function strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }

}
