<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
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

    public function forDelivery(){
    	$order_id = Request::get('order_id');
    	$delivery_person_id = Request::get('assigned_delivery_person');

    	$data = [
    			'id' => $order_id    			
    		];
    	$result = CPS::findOne('order',$data);
    	
    	$result['status'] = 'for_delivery';
    	$result['delivery_person_id'] = $delivery_person_id;

    	$data = [
    			'id' => $delivery_person_id    			
    		];
    	$result_dp = CPS::findOne('delivery-person',$data);
    	$delivery_person_name = $result_dp['name'];
    	$result['delivery_person_name'] = $delivery_person_name;

    	CPS::save($result,'order');

    	return redirect('/store');
    }
}
