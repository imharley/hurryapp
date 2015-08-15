<?php
use CPS_Simple;
use CPS_Connection;
use CPS_LoadBalancer;

class CPS
{
    public $connection;

    public function connect(){
    	if(empty($this->connection)){
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
			$this->connection = $cpsSimple;		
			return true;
		}else{
			return false;
		}

		
    }

}
