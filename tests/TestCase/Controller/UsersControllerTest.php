<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public function login(): void
    {
        $this->session([
            'Auth' => [
                'id' => 1,
            ],
        ]);
    }

    public function testIndex(): void
    {
        $this->get('/users');

        $this->assertResponseError();
    }

    public function testLogin(): void
    {
        $this->get('/users/login');

        $this->assertResponseOk();
    }

    public function testLogout(): void
    {
        $this->login();
        $this->get('/users/logout');

        $this->assertRedirect('/users/login');
    }

    public function testAddUser(): void
    {
        $this->enableCsrfToken();

        $NovoUsuario = [
            'email' => 'test3@email.com',
            'password' => '333',
            'created' => '2026-03-11 11:56:45',
        ];

        $this->post('/users/register', $NovoUsuario);

        $this->assertResponseSuccess();
    }

    public function testForgotPass(): void
    {
        $this->enableCsrfToken();

        $usuario = [
            'email' => 'test2@email.com',
            'new_password' => '222',
        ];

        $this->post('/users/forgot_password', $usuario);
        $this->assertResponseSuccess();
    }
}
