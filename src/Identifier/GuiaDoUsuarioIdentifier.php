<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         1.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Identifier;

use Authentication\Identifier\Resolver\ResolverAwareTrait;
use Authentication\Identifier\Resolver\ResolverInterface;
use Authentication\Identifier\Resolver\OrmResolver;
use Authentication\Identifier\AbstractIdentifier;
use Cake\Datasource\FactoryLocator;
use App\Identifier\UsuarioAssinantes;
use Cake\Datasource\EntityInterface;

class GuiaDoUsuarioIdentifier extends AbstractIdentifier
{
    use ResolverAwareTrait;
    /**
     * @inheritDoc
     * @param array<string, mixed> $data
     * @return \Cake\Datasource\EntityInterface|array<string, mixed>|null
     */
    public function identify(array $data)
    {
        $identity = null;
        $user = $this->getFormUser($data);
        $usuarioAssinante = $this->login($user);
        if (is_string($usuarioAssinante)) {
            $this->_errors[] = $usuarioAssinante;
        } else {
            $identity = $this->getUserEntity($data);
            if (!empty($identity)) {
                if ($identity === true) {
                    $identity = $usuarioAssinante;
                } else {
                    /** @var \App\Model\Entity\User $identity */
                    $identity->usuario_assinante = $usuarioAssinante;
                }
            } else {
                $this->_errors[] = 'Usuário não encontrado.';
            }
        }

        return $identity;
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public function getFormUser(array $data): array
    {
        $user = [];
        $assinanteFields = $this->getConfig('fields.Assinante');
        $usuarioAssinanteFields = $this->getConfig('fields.UsuarioAssinante');
        if (is_array($assinanteFields)) {
            $user['Assinante'] = [];
            foreach ($assinanteFields as $guiaField => $formField) {
                if (isset($data[$formField])) {
                    $user['Assinante'][$guiaField] = $data[$formField];
                }
            }
        }
        if (is_array($usuarioAssinanteFields)) {
            $user['UsuarioAssinante'] = [];
            foreach ($usuarioAssinanteFields as $guiaField => $formField) {
                if (isset($data[$formField])) {
                    $user['UsuarioAssinante'][$guiaField] = $data[$formField];
                }
            }
        }

        return $user;
    }

    /**
     * @param array<string, array<string, mixed>> $user
     * @return array<string, mixed>|string
     */
    public function login(array $user)
    {
        $usuarioTable = new UsuarioAssinantes();
        $usuarioLogado = $usuarioTable->login($user);

        if (!isset($usuarioLogado['UsuarioAssinante'])) {
            if (isset($usuarioLogado['erros'])) {
                if (isset($usuarioLogado['erros']['login'][0])) {
                    $usuarioLogado = $usuarioLogado['erros']['login'][0];
                } else {
                    $usuarioLogado = $usuarioLogado['erros'];
                }
            }
        }

        return $usuarioLogado;
    }

    /**
     * @param array<string, mixed> $data
     * @return EntityInterface|true|null
     */
    public function getUserEntity(array $data)
    {
        /** @var OrmResolver $resolver */
        $resolver = $this->getResolver();

        $userModel = $resolver->getConfig('userModel');
        if (empty($userModel)) {
            return true;
        }

        /** @var \Cake\ORM\Locator\TableLocator $tableLocator */
        $tableLocator = FactoryLocator::get('Table');

        $userTable = $tableLocator->get($userModel);
        $usuarioAssinanteFields = $this->getConfig('fields.UsuarioAssinante');
        $assinanteFields = $this->getConfig('fields.Assinante');
        $conditions = [];
        if (is_array($usuarioAssinanteFields)) {
            foreach ($usuarioAssinanteFields as $userField => $dataField) {
                if ($dataField === self::CREDENTIAL_PASSWORD) {
                    continue;
                }

                if ($userField === 'login') {
                    $userField = 'email';
                }
                $conditions[$userField] = $data[$dataField];
            }
        }
        if (is_array($assinanteFields)) {
            foreach ($assinanteFields as $dataField) {
                $conditions[$dataField] = $data[$dataField];
            }
        }
        $entity = $userTable->newEmptyEntity();
        
        $contain = $resolver->getConfig('contain');

        /** @var \Cake\ORM\Query $query */
        $query = $userTable->find();

        /** @var \App\Model\Entity\User|null $entity */
        $entity = $query
            ->where($conditions)
            ->contain($contain)
            ->first();

        return $entity;
    }
}
