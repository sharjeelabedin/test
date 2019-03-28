<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
Class CloudwaysAPIClient
{
    private $client = null;
    const API_URL = "https://api.cloudways.com/api/v1";
    var $auth_key;
    var $auth_email;
    var $accessToken;
    public function __construct($email,$key)
    {
        $this->auth_email = $email;
        $this->auth_key = $key;
        $this->client = new Client();
        $this->prepare_access_token();
    }
    public function prepare_access_token()
    {
        try
        {
            $url = self::API_URL . "/oauth/access_token";
            $data = ['email' => $this->auth_email,'api_key' => $this->auth_key];
            $response = $this->client->post($url, ['query' => $data]);
            $result = json_decode($response->getBody()->getContents());
            $this->accessToken = $result->access_token;
        }
        catch (RequestException $e)
        {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }
    public function StatusCodeHandling($e)
    {
        if ($e->getResponse()->getStatusCode() == '400')
        {
            $this->prepare_access_token();
        }
        elseif ($e->getResponse()->getStatusCode() == '422')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '500')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '401')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '403')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        elseif ($e->getResponse()->getStatusCode() == '404')
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
        else
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
    }
public function git_pull($serverid,$appid,$giturl,$branchname)
{
    try
    {
        $url = self::API_URL . "/git/pull";
        $option = array('exceptions' => false);
        $data = [
                    'server_id' => $serverid,
                    'app_id' => $appid,
                    'git_url' => $giturl,
                    'branch_name' => $branchname
                ];
        $header = array('Authorization'=>'Bearer ' . $this->accessToken);
        $response = $this->client->post($url, array('query' => $data, 'headers' => $header));
        $result = json_decode($response->getBody()->getContents());
        return $result;
    }
    catch (RequestException $e)
    {
        $response = $this->StatusCodeHandling($e);
        return $response;
    }
}
}
?>
