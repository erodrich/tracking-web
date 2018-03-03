<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HttpRequestsController extends Controller
{
    //protected $base_uri = 'http://locations.test/api/';
    protected $base_uri = 'http://tracking-backend.pbxcct.com/api/';
    /**
     * Testing Guzzle http requests.
     *
     * @return 
     */
    public function test()
    {
        $client = new Client(
            [
                'base_uri' => $this->base_uri,
                'timeout' => 2.0
            ]
        );
        $response = $client->request('GET','locations/354987050678903/date/2018-03-02');
        $jsonFormat = json_decode($response->getBody());
        $locations = $jsonFormat->data;
        return $locations;
        //return $this->getCenter($locations);
       
    }



    public function getLastLocation($imei)
    {
        $client = new Client(
            [
                'base_uri' => $this->base_uri,
                'timeout' => 2.0
            ]
        );
        $response = $client->request('GET','location/'.$imei);
        $jsonFormat = json_decode($response->getBody());
        $location = array_shift($jsonFormat->data);
        //$location = $jsonFormat->data[0];
        return $location;
    }

    public function getLocationsByDay($imei, $date){
        $client = new Client(
            [
                'base_uri' => $this->base_uri,
                'timeout' => 2.0
            ]
        );
        $response = $client->request('GET','locations/'.$imei.'/date/'.$date);
        $jsonFormat = json_decode($response->getBody());
        $locations = $jsonFormat->data;
        return $locations;
    }
}
