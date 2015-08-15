<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\CustomerLogin;

/**
 * Class CustomerAPIController
 * @package App\Http\Controllers
 */
class CustomerAPIController extends Controller
{
    
//    protected $middleware = [
//        'cors',  
//    ];
//    

    public function __construct()
    {
        $this->middleware('cors');
    }

    /**
     * 
     */
    public function login()
    {
        $login = new CustomerLogin();
        $login->phone = \Input::get('phone');
        $login->password = \Input::get('password');
        $login->name = \Input::get('name');
        $login->email = \Input::get('email');

        $response = ['success' => false];
        if ($login->execute()) {
            $customer = Customer::instance($login->record());
            $response['success'] = true;
            if ($login->password) {
                $response['token'] = $customer->data['token'];
            } else {
                $response['is_new'] = $customer->isNew();
            }
        }
        return $response;
    }

    /**
     * 
     */
    public function recentOrders()
    {
    }

    /**
     * 
     */
    public function createOrder()
    {
        
    }

    /**
     * 
     */
    public function updateOrderStatus()
    {
        
    }
}
