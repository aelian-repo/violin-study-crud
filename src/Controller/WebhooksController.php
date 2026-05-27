<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * @property \App\Model\Table\UsersTable $Users
 */
class WebhooksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Users');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index']);
        $this->Authorization->skipAuthorization();
    }

    public function index(): Response
    {
        $this->request->allowMethod(['post']);

        $data = $this->request->getData();

        $evento = $data['evento'] ?? null;

        if (!$evento) {
            return $this->response->withStatus(400);
        }

        if ($evento === 'usuario_criacao') {
            $this->usuarioCriacao($data);
        } elseif ($evento === 'usuario_alteracao') {
            $this->usuarioAlteracao($data);
        } elseif ($evento === 'usuario_exclusao') {
            $this->usuarioExclusao($data);
        }

        $this->autoRender = false;

        return $this->response->withStatus(200);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function usuarioCriacao(array $data): void
    {
        $password = 'Temp1234';

        $user = $this->Users->newEntity([
            'email' => $data['email'],
            'password' => $password,
            'usuario_assinante_id' => $data['id'],
            'assinante_id' => $data['assinantes'][0]['id'],
        ]);

        $this->Users->save($user, [
            'fromWebhook' => true,
        ]);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function usuarioAlteracao(array $data): void
    {
        $user = $this->Users
            ->find()
            ->where([
                'usuario_assinante_id' => $data['id'],
            ])
            ->first();

        if (!$user) {
            return;
        }

        /** @var \App\Model\Entity\User $user */
        $user->email = $data['email'];

        if (!empty($data['senha'])) {
            $user->password = $data['senha'];
        }

        if (
            !$this->Users->save($user, [
            'fromWebhook' => true,
            ])
        ) {
        }
    }

    /**
     * @param array<string, mixed> $data
     */
    public function usuarioExclusao(array $data): void
    {
        $user = $this->Users
            ->find()
            ->where([
                'usuario_assinante_id' => $data['id'],
            ])
            ->first();

        if (!$user) {
            return;
        }
    }
}
