<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CPS;
use Request;
use Session;

class Store extends Controller
{
    public function index(){
    	$store_id = Session::get('logged_in');     	

    	$products = CPS::findMany('product',
		  					['store_id'=>$store_id]		  					
		  				);

    	if(!empty($store_id))
    		return view('store.index',compact('products'));
    	else
    		return redirect('/login');
    }

    public function login(){    	
    	    		    	
		  $documents = CPS::findOne('store',
		  					['email'=>Request::get('email'),'password'=>Request::get('password')]		  					
		  				);
		  if(count($documents)){		  	
		  		Session::put('logged_in', $documents['id']);		  	
		  		return redirect('/store');
		  }else{
		  	$error_msg = "Store account not found.";
		  	return view('store.login',compact('error_msg'));	
		  }
		    
		 
		  
    }

    public function add(){    			

		// Creating a new document
		$document = array(
			'store_name' => Request::get('name'),
			'email' => Request::get('email'),
			'password' => Request::get('password'),
			'store_description' => Request::get('description'),
			'document_type' => 'store',				
			'store_location' => array(
		        'longitude' => Request::get('longitude'),
				'latitude' => Request::get('latitude')
			),
			'store_hours' => array(
		        'open' => Request::get('open'),
				'close' => Request::get('close')
			)
		);

		$save_store = CPS::save($document,'store');

		// Insert			
		if($save_store)
			return redirect('/login');
    	

    	
    }
}
