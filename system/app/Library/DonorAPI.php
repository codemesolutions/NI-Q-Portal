<?php

namespace App\Library;

use GuzzleHttp\Client;

class DonorAPI
{
    private $baseURL;
    private $client;
    private $token;
    private $username;
    private $password;


    public function __construct($baseURL, $username, $password){
       $this->setBaseUrl($baseURL);
       $this->setUsername($username);
       $this->setPassword($password);
    }

    public function setBaseUrl($baseURL){
        $this->baseURL = $baseURL;
    }

    public function getBaseUrl(){
        return $this->baseURL;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }


    protected function authorize(){
        $this->client = new Client();

        $res = $this->client->request('POST', $this->baseURL . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password'
            ],

            'auth' =>  [
                $this->username,
                $this->password
            ]
        ]);

        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = $res->getBody()->getContents();
        }

        $responseObject = json_decode($response_data);
        $this->token = $responseObject->access_token;
    }

    public function getToken(){
        return $this->token;
    }

    public function getDonors(){
        return $this->get('api/donor');
    }

    public function get($uri){
        
        $this->authorize();

        //dd($this->token);
        if(!is_null($this->token)){
            $res = $this->client->request('GET', $this->baseURL . $uri, [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $this->token,        
                    
                ],
            ]);
            

            
            if ($res->getStatusCode() == 200) { // 200 OK
                $response_data = $res->getBody()->getContents();

                return  json_decode($response_data);
            }

            return $res->getStatusCode();
        }

        throw new Exception("No Bearer token found");
    }

    public function post($uri, Array $data){
        
        $this->authorize();

        //dd($this->token);
        if(!is_null($this->token)){
            $res = $this->client->request('POST', $this->baseURL . $uri, [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $this->token,        
                    
                ],
                'form_params' => $data
            ]);
            

            
            if ($res->getStatusCode() == 200) { // 200 OK
                $response_data = $res->getBody()->getContents();

                return  json_decode($response_data);
            }

            return $res->getStatusCode();
        }

        throw new Exception("No Bearer token found");
    }
}