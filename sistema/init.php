<?php

// carrega arquivo de configuração
// require_once($_SERVER['DOCUMENT_ROOT'] . "/sistema/config.inc.php");
require_once("config.inc.php");
require_once("config.martha_sys.inc.php");

function __autoload($class) {
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "/class/class." . ucwords($class) . ".php");
}