<?php
use CPS_Simple;
use CPS_Connection;
use CPS_LoadBalancer;

/**
 * Class CPS
 */
class CPS
{
	/** @var CPS_Simple */
    private static $_connection;

	/**
	 * @return \CPS_Simple
	 */
	public static function instance()
	{
		if (empty(static::$_connection)) {
			$connectionStrings = array(
				'tcp://cloud-us-0.clusterpoint.com:9007',
				'tcp://cloud-us-1.clusterpoint.com:9007',
				'tcp://cloud-us-2.clusterpoint.com:9007',
				'tcp://cloud-us-3.clusterpoint.com:9007',
			);
			$cpsConn = new CPS_Connection(
				new CPS_LoadBalancer($connectionStrings),
				'hurryapp',
				'developer@ideasmaker.net',
				'island123!',
				'document',
				'//document/id',
				array('account' => 101125));
			//$cpsConn->setDebug(true);	
			$cpsSimple = new CPS_Simple($cpsConn);
			static::$_connection = $cpsSimple;
		}
		return static::$_connection;
	}
}
