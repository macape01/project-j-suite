<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use My\User;

final class UserTest extends TestCase
{
    public function testAuthentication(): void
    {
        $isAuth = User::isAuth();
        echo "IsAuthenticated: ".$isAuth;
        $this->assertFalse($isAuth,"turkish");
    }

}
?>