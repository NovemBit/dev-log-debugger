<?php


namespace DevLogDebugger;


use DevLog\DevLog;

class DevLogDebugger {

	/**
	 * @throws \Exception
	 */
	public static function init() {
		self::setConstants();

		DevLog::register();

		new Controller();
	}

	private static function setConstants(){

		if(!defined('DEV_LOG_EXCLUSION')){
			define( 'DEV_LOG_EXCLUSION', [ self::class, 'setExclusion' ] );
		}

		if ( ! defined( "DEV_LOG_URL_PATH" ) ) {
			define( "DEV_LOG_URL_PATH", 'debugger' );
		}

		if ( ! defined( "DEV_LOG_IP_ADDRESSES" ) ) {
			define( "DEV_LOG_IP_ADDRESSES", [ '*' ] );
		}

		if ( ! defined( "DEV_LOG_DEBUGGER" ) ) {
			define( "DEV_LOG_DEBUGGER", true );
		}

		if ( ! defined( "DEV_LOG_INLINE_DEBUGGER" ) ) {
			define( "DEV_LOG_INLINE_DEBUGGER", true );
		}
	}

	public static function setExclusion(){

		if ( preg_match('/^\/'.DEV_LOG_URL_PATH.'/',$_SERVER["REQUEST_URI"])) {
			return true;
		}

		return false;
	}
}