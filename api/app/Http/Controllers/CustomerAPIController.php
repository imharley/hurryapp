<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\CustomerLogin;
use Carbon\Carbon;

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
//        $this->middleware('apiAuth');
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
    public function stores()
    {
        $tz = 'Asia/Manila';
        $stores = \CPS::findMany('store');
        $current = Carbon::now($tz);
        if ($stores) {
            foreach ($stores as &$store) {
                unset($store['password']);
                $open = Carbon::createFromFormat('Y-m-d h:iA', $current->toDateString() . ' ' . $store['store_hours']['open'], $tz);
                $close = Carbon::createFromFormat('Y-m-d h:iA', $current->toDateString() . ' ' . $store['store_hours']['close'], $tz);
                $store['items'] = (array) \CPS::findMany('product', ['store_id' => $store['id']]);
                $store['status'] = $current->between($close, $open);
            }
        }
        return $stores;
    }

    /**
     * 
     */
    public function recentOrders()
    {
        return \CPS::findMany('order', ['customer' => ['id' => Customer::getCurrent()->data['id']]]);
    }

    /**
     * 
     */
    public function createOrder()
    {
        $order = \Input::all();
        $order['change'] = $order['money'] - $order['total'];
        $order['status'] = 'pending';
        $order['timestamp'] = time();
        $store = \CPS::findOne('store', ['id' => $order['store']['store_id']]);
        $order['store']['name'] = $store['store_name'];
        $order['store']['description'] = $store['store_description'];
        $order['store']['latitude'] = $store['store_location']['latitude'];
        $order['store']['longitude'] = $store['store_location']['longitude'];
        $order['customer'] = [
            'id' => Customer::getCurrent()->data['id'],
            'name' => Customer::getCurrent()->data['name'],
            'phone' => Customer::getCurrent()->data['phone'],
            'email' => Customer::getCurrent()->data['email'],
            'location' => [    
                'latitude' => 7.0723308,
                'longitude' => 125.6106872,
//                'latitude' => $_COOKIE['latitude'],
//                'longitude' => $_COOKIE['longitude'],
            ],
        ];
        return \CPS::save($order, 'order');
    }

    /**
     * 
     */
    public function updateOrderStatus($orderId)
    {
        $order = \CPS::findOne('order', ['id' => $orderId]);
        $order['status'] = 'cancelled';
        \CPS::save($order, 'order');
        return ['success' => 1];
    }
}
