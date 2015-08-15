<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use Flysystem;
use Input;	
use Validator;
use File;

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
            //$extension = $file->getClientOriginalExtension();
            $destinationPath = 'uploads';
            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $file->getClientOriginalName();
           $upload_success = $file->move($destinationPath, $fileName); 
          
           
    	Flysystem::put($fileName, File::get($upload_success));

    	return '';
    }
}
