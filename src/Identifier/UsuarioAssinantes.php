<?php
declare(strict_types=1);

namespace App\Identifier;

use Cake\Core\Configure;

class UsuarioAssinantes
{
    protected ?string $params = null;

    /**
     * @param array<string, array<string, mixed>> $usuarioAssinante
     * @return array<string, mixed>|null
     */
    public function login($usuarioAssinante): ?array
    {
        $this->params = 'login';

        return $this->request('POST', $usuarioAssinante);
    }

    /**
     * @param string $method
     * @param array<string, mixed> $resource
     * @return array<string, mixed>|null
     */
    public function request(string $method, array $resource = []): ?array
    {
        $resource = json_encode($resource, JSON_THROW_ON_ERROR);
        $curl = curl_init($this->getUrl());

        if ($method === '') {
            return null;
        }
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $resource);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
           'Content-Type: application/json',
           'Content-Length: ' . strlen($resource),
           'User-Agent: Aelian-GuiaDoUsuario-Plugin',
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            $result = ['erros' => curl_error($curl)];
        } else {
            /** @var string $response */
            $result = json_decode($response, true);
        }
        if (!is_array($result)) {
            return null;
        }

        curl_close($curl);

        return $result;
    }

    public function getUrl(): string
    {
        $url = Configure::read('Onboarding.baseUrl');
        $path = 'api-usuario-assinantes';
        $versao = Configure::read('App.onboardingVersao') . '/';
        $chave = Configure::read('App.onboardingChave') . '/';
        $params = !empty($this->params)
            ? '/call/' . $this->params
            : '';

        return $url . $versao . $chave . $path . $params;
    }
}
