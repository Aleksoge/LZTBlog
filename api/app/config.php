<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require $_SERVER['DOCUMENT_ROOT'].'/app/dbRBController.php';
$configBaseHost = "mysql";
$configBaseName = "lztblog";
$configBaseUser = "lztalex";
$configBasePassword = "qYxvZsEg";

R::setup('mysql:host='.$configBaseHost.';dbname='.$configBaseName,  $configBaseUser, $configBasePassword);

if ( !R::testconnection() )
{
		exit ('DB config error.');
}

R::ext('dpns', function( $type ){
    return R::getRedBean()->dispense( $type );
});

R::close();

if(!isset($_SESSION)) { session_start(); }