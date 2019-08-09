<?php

include_once __DIR__ . "/vendor/autoload.php";

try {
	spl_autoload_register( function ( $className ) {

		if ( preg_match( '/^DevLogDebugger\\\\.*/', $className ) ) {

			$className = preg_replace( '/^DevLogDebugger/', 'src\inc', $className );

			$className = str_replace( "\\", DIRECTORY_SEPARATOR, $className );

			include_once( __DIR__ . "/$className.php" );
		}
	} );
} catch ( Exception $e ) {
	throw new Exception("Can't register class autoload function.");
}

use DevLogDebugger\DevLogDebugger;

//if ( ! defined( "DEV_LOG_DB" ) ) {
//	define( "DEV_LOG_DB", [
////		'pdo'=>'sqlite:'.dirname( __FILE__ ) . '/runtime/db/DevLog.db',
//		'pdo'      => 'mysql:host=localhost;dbname=swanson',
//		'username' => 'root',
//		'password' => 'Novem9bit',
//		'config'   => [
//			\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false
//		]
//	] );
//}

DevLogDebugger::init();