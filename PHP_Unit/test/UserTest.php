<?php

use PHPUnit\Framework\TestCase;
use App\Play\User;

class UserTest extends TestCase
{
    public function testClassHasAttributeAge()
    {
        $attr = 'age';
        $this->assertClassHasAttribute($attr, User::class);
    }

    public function testClassHasAttributeEmail()
    {
        $email = 'email';
        $this->assertClassHasAttribute($email,User::class);
    }

    public function testIsInt()
    {
        $age = 10;
        $user = new User();
        $this->assertIsInt($user->setAge($age));
    }

    public function testCannotBeCreatedFromInvalidEmailAddress()
    {
        $this->expectException(Exception::class);
        $user = new User();
        $user->setEmail("suryono");
    }
}
