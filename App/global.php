<?php

//==============================
//=
//= TO OPEN HUBMENU SERVER:
//= C:\Xampp\Php\php.exe -S localhost:8080
//=
//==============================

date_default_timezone_set('America/Sao_Paulo');
define('DB_HOST'     , "localhost");
define('DB_PORT'     , "3306");
define('DB_USER'     , "root");
define('DB_PASSWORD' , "");
define('DB_DRIVER'   , "mysql");
define('DB_NAME'     , "db_hubmenu");

// constantes do phpMailer
define('PHPMAILER_USERNAME', "contatosistemassenai@gmail.com");
define('PHPMAILER_PASSWORD', "nwpk zlni mlhs hzww");

//SMS - IAgente
define('IAgente_USER'     , 'mark_stolf@estudante.sesisenai.org.br');
define('IAgente_PASS'     , 'Mark@123');

$Title   = "HubMenu |";
$Website = "http://localhost:8080";

?>