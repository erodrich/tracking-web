<?php

namespace App\Http\Controllers;

use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;

use App\Http\Requests;

class MapController extends Controller
{
    protected $gmap;
    protected $config = [
        'center' => 'lima, Peru',
        'zoom' => 'auto',
        'map_height' => '500px'
    ];

    public function __construct(){
        $this->gmap = new GMaps;
    }

    public function setConfig($key, $value){
        $this->config[$key] = $value;
    }

    public function cInitialize(){
        $this->gmap->initialize($this->config);
    }

    public function add_marker($marker){
        $this->gmap->add_marker($marker);
    }

    public function create_map(){
        return $this->gmap->create_map();
    }

    
}
