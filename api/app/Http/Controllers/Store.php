<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CPS;
use Request;

class Store extends Controller
{
    public function index(){
    	return view('store.index');
    }

    public function login(){    	
    	    		
    	// search for items with category == 'cars' and car_params/year >= 2010
		  $query = CPS_Term(Request::get('email'), 'email') . CPS_Term(Request::get('password'), 'password'); 
		  // return documents starting with the first one - offset 0
		  $offset = 0;
		  // return not more than 5 documents
		  $docs = 1;
		  // return these fields from the documents
		  $list = array(
		    'id' => 'yes',
		    'email' => 'yes',
		    'store_name' => 'yes'
		  );
		  // order by year, from largest to smallest
		  $ordering = CPS_NumericOrdering('id', 'descending');
		  $documents = CPS::instance()->search($query, $offset, $docs, $list, $ordering);

		  if(count($documents))
		  	return redirect('/store');
		  else{
		  	$error_msg = "Store account not found.";
		  	return view('store.login',compact('error_msg'));	
		  }
		    
		 
		  
    }

    public function add(){
    	$cps = new CPS();
    	if($cps->connect()){
    		$cpsSimple = $cps->connection;	

    		// Creating a new document
			$document = array(
				'store_name' => Request::get('name'),
				'email' => Request::get('email'),
				'password' => Request::get('password'),
				'store_description' => Request::get('description'),
				'document_type' => 'store',				
				'store_location' => array(
			        'longtitude' => Request::get('longtitude'),
					'latitude' => Request::get('latitude')
				),
				'store_hours' => array(
			        'open' => Request::get('open'),
					'close' => Request::get('close')
				)
			);

			// Insert			
			if($cpsSimple->insertSingle(uniqid('store_'), $document))
				return redirect('/login');
    	}

    	
    }
}
