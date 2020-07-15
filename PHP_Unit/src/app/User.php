<?php

namespace App\Play;

use Exception;

class User
{
    protected $age, $email;

    public function setAge($age)
    {
        return $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Exception("$this->email Not a valid email address",1);
        }
        else{
            return $this->email = $email;
        }
        
    }

    public function getEmail()
    {
        return $this->email;
    }
}