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
        if (!($token = $_COOKIE['_token'])) {
            return $next($request);
        }
        $customer = Customer::retrieveByToken($token);
        if (!$customer) {
            return response()->json(['success' => 0]);
        }
        Customer::setCurrent($customer);
        return $next($request);
    }
}