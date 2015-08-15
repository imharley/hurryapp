<?php
Namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use Flysystem;
use Input;	
use Validator;
use File;
use Session;
use CPS;

class Delivery extends Controller
{
    public function addPerson(){
    	$store_id = Session::get('logged_in');
    	$delivery_person = array(
			'name' => Request::get('name'),
			'username' => Request::get('username'),
			'password' => Request::get('password'),			
			'store_id' => $store_id			
		);
		

    	if(CPS::save($delivery_person,'delivery-person'))
    		$msg_alert = array('code'=>'1','msg'=>'Delivery person successfully added.','alert_type'=>'success');    		
    	
    	return redirect('/store');
    }
}
