<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class WeatherManager
{
    private $database;
    
    public function __construct(Database $database)
    {
        $this->database = $database->getPdo();
    }

    public function weatherOfLocation(string $location)
    {
        //var_dump($location); die();

        $queryString = http_build_query([
          'access_key' => '6fba33e9403000461809acbf44b137de',
          'query' => $location,
        ]);
        
        //var_dump($queryString); die();  // string(58) "access_key=6fba33e9403000461809acbf44b137de&query=New+York"
        
        $ch = curl_init(sprintf('%s?%s', 'https://api.weatherstack.com/current', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        var_dump($ch);
        die();   //resource(37) of type (curl)

        $json = curl_exec($ch);
        curl_close($ch);
        
        var_dump($json);
        die(); // bool(false)

        $api_result = json_decode((string) $json, true);
        
        var_dump($api_result);
        die();   // NULL

        return $api_result;
    }
}
