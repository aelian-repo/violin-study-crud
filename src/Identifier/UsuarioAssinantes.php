<?php
declare(strict_types=1);

namespace App\Identifier;

use Cake\Core\Configure;
use Cake\Utility\Inflector;

class UsuarioAssinantes
{
    protected $params;

    public function login($usuarioAssinante) 
    {   
        $this->params = 'login';
    
        return $this->request('POST', $usuarioAssinante);    
    }

    public function request($method, $resource = array()) 
    {
        $resource = json_encode($resource);                                                                   
        $curl = curl_init($this->getUrl());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);                                              
        curl_setopt($curl, CURLOPT_POSTFIELDS, $resource);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);        
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                           
           'Content-Type: application/json',                                                         
           'Content-Length: ' . strlen($resource),                                                        
           'User-Agent: Aelian-GuiaDoUsuario-Plugin',
        ));                                                                                           
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $response = array('erros' => curl_error($curl));            
        } else {
            $response = json_decode($response, true);
        }
        curl_close($curl);

        return $response;                
    }       
    
    public function getUrl()
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
