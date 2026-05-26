<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SessoesController Test Case
 *
 * @uses \App\Controller\SessoesController
 */
class SessoesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sessoes',
        'app.Users',
        'app.Apostilas',
    ];

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
        $this->login();
        $this->get('/sessoes');

        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->login();
        $this->get('/sessoes/view/1');

        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->login();
        $this->get('/sessoes/add');

        $this->assertResponseOk();
    }

    public function testAddPost(): void
    {
        $this->login();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();

        $SessaoCriada = [
            'user_id' => 1,
            'apostila_id' => 1,
            'name' => 'Sessão 1',
            'sessao_date' => '2026-03-10',
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'conteudo' => 'abc',
            'objetivo' => '123',
        ];

        $this->post('/sessoes/add', $SessaoCriada);

        $this->assertResponseSuccess();
        $this->assertFlashMessage('Sessão salva com sucesso!');

        $sessoes = $this->getTableLocator()->get('Sessoes');

        $this->assertEquals(
            1,
            $sessoes->find()->where(['name' => 'Sessão 1'])->count()
        );
    }

    public function testDelete(): void
    {
        $this->login();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $SessaoDeletada = [
            'name' => 'Sessão 01',
        ];

        $this->post('/sessoes/delete/1', $SessaoDeletada);

        $this->assertResponseSuccess();
        $this->assertFlashMessage('Sessão deletada!');
    }
}
