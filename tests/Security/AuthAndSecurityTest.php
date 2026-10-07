<?php

namespace Tests\Security;

use Tests\TestCase;

class AuthAndSecurityTest extends TestCase
{
    public function testPasswordHashing(): void
    {
        $password = 'Secret123!';
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->assertTrue(password_verify($password, $hash));
        $this->assertFalse(password_verify('WrongPassword', $hash));
    }
}
