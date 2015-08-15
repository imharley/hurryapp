<?php

namespace App\Models;

/**
 * Class Customer login
 */
class CustomerLogin
{
    /** @var   */
    public $phone;
    /** @var   */
    public $password;
    
    public $name;
    
    public $email;

    private $_record;
    
    /**
     * @return boolean
     */
    public function execute()
    {
        
        if (!$this->phone && !$this->password) {
            return false;
        }
        
        if ($this->phone && !$this->password) {
            if (!($record = $this->record())) {
                $this->register();
            }
            $this->sendOTP();
            return true;
        }
        return $this->login();
    }

    /**
     * 
     */
    public function record()
    {
        if ($this->_record) {
            return $this->_record;
        }
        return $this->_record = \CPS::findOne('customer', ['phone' => $this->phone]);
    }

    /**
     * @return boolean
     */
    protected function sendOTP()
    {
        $config = \Config::get('chikka');
        $chikka = new \ChikkaSMS($config['client_id'], $config['secret_key'], $config['shortcode']);
//        $password = (string) rand(1000, 9999);
        $password = '12345';
//        $chikka->sendText(uniqid(), '639462952292', $password);
        $record = $this->record();
        $record['password'] = $password;
        \CPS::save($record);
    }

    /**
     * @return boolean
     */
    protected function register()
    {
        $this->_record = \CPS::save([
            'phone' => $this->phone,
        ], 'customer');
    }

    /**
     * @return boolean
     */
    protected function login()
    {
        if ($this->password != $this->record()['password']) {
            return false;
        }
        $record = $this->record();
        if ($this->name && $this->email) {
            $record['name'] = $this->name;
            $record['email'] = $this->email;
        }
        $record['token'] = md5(uniqid());
        \CPS::save($record);
        return true;
    }
}
