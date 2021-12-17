<?php

use PHPUnit\Framework\TestCase;
use My\User;

final class UserTest extends TestCase
{
    public function authenticationTest(): bool
    {
        $isAuth = User::isAuth();
        echo "IsAuthenticated: ".$isAuth;
        $this->assertFalse($isAuth,"turkish");

    }

}
?>