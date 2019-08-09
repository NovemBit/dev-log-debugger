<?php


namespace DevLogDebugger;


use DevLog\DevLog;

class DevLogDebugger {

	/**
	 * DevLogDebugger initialization method
	 *
	 * @throws \Exception
	 */
	public static function init() {

		self::setConstants();

		/**
		 * If debugger enabled
		 * then register DevLog and routes
		 * */
		if ( DEV_LOG_DEBUGGER !== false ) {

			/*
			 * Register DevLog
			 * */
			DevLog::register();

			/*
			 * Register Controller routes
			 * */
			new Controller();
		}
	}

	/**
	 * Set standard constants
	 */
	private static function setConstants() {

		if ( ! defined( 'DEV_LOG_EXCLUSION' ) ) {
			define( 'DEV_LOG_EXCLUSION', [ self::class, 'setExclusion' ] );
		}

		if ( ! defined( 'DEV_LOG_DEBUGGER_PATH' ) ) {
			define( 'DEV_LOG_DEBUGGER_PATH', __DIR__ );
		}

		if ( ! defined( "DEV_LOG_DEBUGGER_URL_PATH" ) ) {
			define( "DEV_LOG_DEBUGGER_URL_PATH", 'debugger' );
		}

		if ( ! defined( "DEV_LOG_DEBUGGER_IP_ADDRESSES" ) ) {
			define( "DEV_LOG_DEBUGGER_IP_ADDRESSES", [ '*' ] );
		}

		if ( ! defined( "DEV_LOG_DEBUGGER" ) ) {
			define( "DEV_LOG_DEBUGGER", true );
		}

		if ( ! defined( "DEV_LOG_INLINE_DEBUGGER" ) ) {
			define( "DEV_LOG_INLINE_DEBUGGER", true );
		}
	}

	/**
	 * To avoid that DevLog not logging
	 * Debugger pages, making exclusion callback function
	 * To match url path with DEV_LOG_DEBUGGER_URL_PATH constant
	 *
	 * Should be public
	 * @return bool
	 */
	public static function setExclusion() {

		if ( preg_match( '/^\/' . DEV_LOG_DEBUGGER_URL_PATH . '/', $_SERVER["REQUEST_URI"] ) ) {
			return true;
		}

		return false;
	}
}