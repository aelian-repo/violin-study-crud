<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ApostilasController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ApostilasController Test Case
 *
 * @uses \App\Controller\ApostilasController
 */
class ApostilasControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Apostilas',
        'app.Users'
    ];

    public function login(): void
    {
        $this->session([
            'Auth' => [
                'id' => 1
            ]
        ]); 
    }

    public function testIndex(): void
    {
        $this->login();
        $this->get('/apostilas');

        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->login();
        $this->get('/apostilas/view/1');

        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->login();
        $this->get('/apostilas/add');

        $this->assertResponseOk();
    }

    public function testAddUpload(): void
    {
        $this->login();

        $this->enableCsrfToken();

        $origem = TESTS . 'Fixture/files/test.pdf';
        $destino = TESTS . 'Fixture/files/temp.pdf';
        copy($origem, $destino);
        
        $pdf = new \Laminas\Diactoros\UploadedFile(
            $destino,
            1000,
            UPLOAD_ERR_OK,
            'test.pdf',
            'application/pdf'
        );

        $this->configRequest([
            'files' => [
                'arquivo' => $pdf
            ]
        ]);

        $ApostilaCriada = [
            'user_id' => 1,
            'name' => 'Apostila Teste',
            'nivel' => 'Iniciante',
            'arquivo' => $pdf
        ];

        $this->post('/apostilas/add', $ApostilaCriada);

        $this->assertResponseSuccess();
    }
}
