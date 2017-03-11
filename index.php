<?php session_start();
/**
 * @author by Nhatnv - skype nhat.89
 * @fameworkName OneBIG
 * @verison
 *        |______1.0.0 #Start 02/05/2016
 *                   | what news ?
 *                   |__ Base fw
 *        |______1.0.1 #Update 09/09/2016
 *                   | what news ?
 *                   |__ add function getParamString, getParamInt
 *        |______1.0.2 #Update 01/02/2017
 *                   | what news ?
 *                   |__ update method call database ( $this->db()->... => $this->db->... )
 *
 */
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once('constant.php');
switch (ENVIRONMENT) {
    case 'dev':
        set_error_handler("handleError");
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        break;
    case 'dep':
    default:
        ini_set('display_errors', 0);
        break;
}

function handleError($errno, $errstr, $error_file, $error_line) {
    echo "<h3>Detail Bug\n</h3>";
    echo "<b>Error:</b> [$errno] $errstr";
    echo "<br /><b>File:</b> $error_file - <b>Line</b>:$error_line";
    echo "<br />---------------------------------------------";
}

/**
 * @void Load Autoload
 */
require_once('App/Config/Autoload.php');


/**
 * @void Load App
 */
require_once('App/App.php');

/**
 * @void Run Application
 */
$RunApp = new RunApp();
$RunRouter = $Router->run($RunApp);
