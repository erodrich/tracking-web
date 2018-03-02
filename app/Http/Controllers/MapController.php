<?php

namespace App\Http\Controllers;

use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;

use App\Http\Requests;

class MapController extends Controller
{
    protected $gmap;

    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
        $config = array();

    }

    
}
