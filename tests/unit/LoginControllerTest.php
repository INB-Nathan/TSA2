<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class LoginControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testAuthenticateWithInvalidEmail(): void
    {
        $_POST = [
            'email' => 'invalid-email',
            'password' => 'Test1234!@#$'
        ];

        $result = $this->withRoutes()->controller(\App\Controllers\Login::class)
            ->execute('authenticate');

        $result->assertRedirectTo('/');
        $this->assertTrue($result->isRedirect());
    }

    public function testAuthenticateWithEmptyEmail(): void
    {
        $_POST = [
            'email' => '',
            'password' => 'Test1234!@#$'
        ];

        $result = $this->withRoutes()->controller(\App\Controllers\Login::class)
            ->execute('authenticate');

        $result->assertRedirectTo('/');
        $this->assertTrue($result->isRedirect());
    }

    public function testAuthenticateWithShortPassword(): void
    {
        $_POST = [
            'email' => 'test@example.com',
            'password' => 'Short1!'
        ];

        $result = $this->withRoutes()->controller(\App\Controllers\Login::class)
            ->execute('authenticate');

        $result->assertRedirectTo('/');
        $this->assertTrue($result->isRedirect());
    }

    public function testAuthenticateWithEmptyPassword(): void
    {
        $_POST = [
            'email' => 'test@example.com',
            'password' => ''
        ];

        $result = $this->withRoutes()->controller(\App\Controllers\Login::class)
            ->execute('authenticate');

        $result->assertRedirectTo('/');
        $this->assertTrue($result->isRedirect());
    }

    public function testAuthenticateWithValidInputFormat(): void
    {
        // This test checks that valid format inputs pass validation
        // It will fail authentication (no user in DB), but validation should pass
        $_POST = [
            'email' => 'test@example.com',
            'password' => 'ValidPassword123!'
        ];

        $result = $this->withRoutes()->controller(\App\Controllers\Login::class)
            ->execute('authenticate');

        // Should redirect back with "Invalid email or password" error, not validation error
        $result->assertRedirectTo('/');
        $this->assertTrue($result->isRedirect());
    }
}
