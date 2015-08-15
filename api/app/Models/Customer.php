<?php

namespace App\Models;

use CPS;

/**
 * Class Customer
 * @package App\Models
 */
class Customer
{
    const TYPE = 'customer';
    
    public $data;
    
    private static $_customer;
    
    /**
     * @param $id
     * @return static
     */
    public static function retrieve($id)
    {
        $document = CPS::findOne(static::TYPE, 'id', $id);
        if ($document) {
            return static::instance($document);
        }
        return $document;
    }

    /**
     * @param $id
     */
    public static function retrieveByPhone($phone)
    {
        $record = CPS::findOne(static::TYPE, ['phone' => $phone]);
        if ($record) {
            return static::instance($record);
        }
        return null;
    }
    
    /**
     * @param $token
     * @return static
     */
    public static function retrieveByToken($token)
    {
        $record = CPS::findOne(static::TYPE, ['token' => $token]);
        if ($record) {
            return static::instance($record);
        }
        return null;
    }

    /**
     * @param object $customer
     * @return static
     */
    public static function instance($customer)
    {
        $model = new static();
        $model->data = $customer;
        return $model;
    }

    /**
     * 
     */
    public function save()
    {
        return (boolean) CPS::save($this->data);
    }

    /**
     * @return boolean
     */
    public function isNew()
    {
        return !isset($this->data['name']) && !isset($this->data['email']);
    }

    /**
     * @param $user
     */
    public static function setCurrent($user)
    {
        static::$_customer = $user;
    }

    /**
     * @return mixed
     */
    public static function getCurrent()
    {
        return static::$_customer;
    }
}