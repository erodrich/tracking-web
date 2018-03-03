<?php

namespace App\Http\Controllers;

use App\User;
use App\Utils\CustomMap;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use App\Http\Controllers\HttpRequestsController;
use App\Http\Controllers\MapController;

class DashboardController extends Controller
{
    //protected $gmap;
    protected $mapController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->gmap = new GMaps;
        $this->mapController = new MapController;
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $requests = new HttpRequestsController;
        $locations = array();

        foreach($user->devices as $device){
            $locations[] = $requests->getLastLocation($device->imei);
        }
        if(count($locations) > 0){
            for($i = 0; $i < count($locations); $i++){
                if(!empty($locations[$i])){
                    $markers[$i]['position'] = $locations[$i]->latitud.','.$locations[$i]->longitud;
                    $markers[$i]['infowindow_content'] = '<h3>'.$user->devices[$i]->alias.'</h3>'
                                                        .'<ul>'
                                                        .'<li>Telefono: '.$user->devices[$i]->phone.'</li>'
                                                        .'<li>Fecha: '.$locations[$i]->fecha.'</li>'
                                                        .'<li>Hora: '.$locations[$i]->hora.'</li>'
                                                        .'</ul>'
                                                        ;                                                        ;
                    $this->mapController->add_marker($markers[$i]);
                }
            }
        }

        //$this->gmap = CustomMap::setControls($this->gmap);
        //$this->gmap->initialize(CustomMap::CONFIG);
        $center = CustomMap::getCenter($locations);
        $this->mapController->setConfig('center', $center);
        $this->mapController->setConfig('zoom', '16');
        $this->mapController->cInitialize();
        $map = $this->mapController->create_map();
        
        
        $data = [
            'map' => $map,
            'devices' => $user->devices,
        ];
        return view('dashboard')->with('data', $data);
    }
}
