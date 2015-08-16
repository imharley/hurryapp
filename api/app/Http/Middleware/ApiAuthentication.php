<?php
/**
 * Created by PhpStorm.
 * User: darkunz
 * Date: 8/15/15
 * Time: 9:43 PM
 */

namespace App\Http\Middleware;
use App\Models\Customer;

/**
 * Class ApiAuthentication
 * @package App\Http\Middleware
 */
class ApiAuthentication
{
    /***
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (\Route::current()->getActionName() == 'App\Http\Controllers\CustomerAPIController@login') {
            return $next($request);
        }
        if (!($request->cookie('_token'))) {
            return response()->json(['success' => 0]);
        }
        $token = $request->cookie('_token');
        $customer = Customer::retrieveByToken($token);
        if (!$customer) {
            return response()->json(['success' => 0]);
        }
//        $customer->data['lastLocation'] = [
//            'lat' => $_COOKIE['lat'],
//            'lng' => $_COOKIE['lng'],
//        ];
        Customer::setCurrent($customer);
        return $next($request);
    }
}