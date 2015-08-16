<?php

namespace App\Http\Controllers;

/**
 * Class DeliveryAPIController
 * @package App\Http\Controllers
 */
class DeliveryAPIController extends Controller
{

//    protected $middleware = [
//        'cors',
//    ];

    public function __construct()
    {
//        $this->middleware('cors');
//        $this->middleware('apiAuth');
    }

    /**
     * 
     */
    public function login()
    {
        $id = \Input::get('id');
        $password = \Input::get('password');
        $deliveryApp = \CPS::findOne('delivery-person', [
            'id' => $id,
            'password' => $password,
        ]);
        if (!$deliveryApp) {
            return ['success' => 0];
        }
        $deliveryApp['token'] = md5(uniqid());
        \CPS::save($deliveryApp);
        return [
            'token' => $deliveryApp['token'],  
        ];
    }

    /**
     * 
     */
    public function orders($id = null)
    {
        if ($id) {
            return \CPS::findOne('order', ['id' => $id]);
        }
        return \CPS::findMany('order', ['status' => 'for_delivery']);
    }    
    
    /**
     * 
     */
    public function updateOrderStatus($id)
    {
        $status = \Input::get('status');
        $order = \CPS::findOne('order', ['id' => $id]);
        $order['status'] = $status;
        \CPS::save($order);
        return ['success' => 1];
    }
}