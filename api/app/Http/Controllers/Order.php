<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use CPS;

class Order extends Controller
{
    public function status($status,$status_id){
    	$data = [
    			'id' => $status_id    			
    		];
    	$result = CPS::findOne('order',$data);
    	
    	$result['status'] = $status;
    	CPS::save($result,'order');

    	return redirect('/store');    	
    }
}
