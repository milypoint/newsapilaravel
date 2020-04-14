<?php


namespace App\NewsApi;


use App\Tools\ClassWithAttributes;
use \GuzzleHttp\Client;

abstract class NewsApiRequest extends ClassWithAttributes
{
    protected static $_query_parameters;
    protected static $_endpoint;
    protected $errors = [];

    protected $baseUrl = 'http://newsapi.org';

    abstract protected function validate($key);

    public function __set($key, $value)
    {
        if (in_array($key, static::$_query_parameters)) {
            $validator = $this->validate($key);
            $validation_result = $validator($value);
            if (!($validator !== null and !$validation_result)) {
                if ($validation_result !== true) {
                    $value = $validation_result;
                }
                parent::__set($key, $value);
            }
        }
    }

    public function __construct(array $_get=[])
    {
        foreach ($_get as $key => $value) {
            $this->$key = $value;
        }
    }

    public function request()
    {
        if (!empty($this->errors)) {
            return [];
        }
        //getting api token:
        $apiToken = config('newsapi.token');
        try {
            if (!$apiToken) {
                config(['newsapi.token' => '']);
                throw new \Exception('NewsApi token not found.');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return [];
        }

        //make request:
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 3.0
        ]);
        $response = $client->request('GET', static::$_endpoint, [
            'query' => $this->_attributes,
            'headers' => [
                'X-Api-Key' => $apiToken
            ]
        ]);

        $result = ['articles' => []];
        foreach (json_decode($response->getBody()->getContents())->articles as $article){
            $art = [];
            foreach ($article as $key => $value) {
                $art[$key] = $value;
            }
            $result['articles'][] = $art;
        }

        return $result;
    }
}
