<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use Flysystem;
use Input;	
use Validator;
use File;
use Session;
use CPS;

class Product extends Controller
{
    public function save(){
    	// GET ALL THE INPUT DATA , $_GET,$_POST,$_FILES.
        $input = Input::all();
        
        // VALIDATION RULES
        $rules = array(
            'file' => 'image|max:3000',
        );
    
       // PASS THE INPUT AND RULES INTO THE VALIDATOR
        $validation = Validator::make($input, $rules);
 
        // CHECK GIVEN DATA IS VALID OR NOT
        if ($validation->fails()) {
            return Redirect::to('/store')->with('message', $validation->errors->first());
        }

	        $file = array_get($input,'product_image');
	        if($file){
	            //$extension = $file->getClientOriginalExtension();
	            $destinationPath = 'uploads';
	            // RENAME THE UPLOAD WITH RANDOM NUMBER
	            $fileName = $file->getClientOriginalName();
	            $upload_success = $file->move($destinationPath, $fileName); 
        	}
        	$store_id = Session::get('logged_in');

        	$s3_url 		= 'products/'.$fileName;
        	$s3_location 	= Flysystem::put($s3_url, File::get($upload_success));        	
    		$s3_bucket 		= Flysystem::getAdapter()->getClient()->getObjectUrl('hurryapp', '');

    		$s3_location 	= ($s3_location)?$s3_bucket.$s3_url:'';
        	
        	$product = array(
				'product_name' => Request::get('product_name'),
				'product_price' => Request::get('product_price'),
				'product_description' => Request::get('product_description'),
				'image' => $s3_location,
				'store_id' => $store_id				
			);
			

        	if(CPS::save($product,'product'))
        			return redirect('/store'); 
    	
    }
}
