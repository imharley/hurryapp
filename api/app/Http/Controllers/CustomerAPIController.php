<?php

namespace App\Http\Controllers;

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
        
    }

    /**
     * 
     */
    public function recentOrders()
    {
        return [];
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
