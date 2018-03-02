<?php

namespace App\Http\Controllers;

use App\User;
use App\Device;
use App\Utils\CustomMap;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use App\Http\Controllers\HttpRequestsController;

class RoutesController extends Controller
{
    protected $gmap;

    public function __construct()
    {
        $this->middleware('auth');
        $this->gmap = new GMaps;
    }
    
    public function route($id, $date)
    {
        //Comprobar que el usuario esta logeado
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //Capturar imei del dispositivo
        $imei = Device::find($id)->imei;
        //Solicitar al backend las ubicaciones del dispositivo para el dia señalado
        $requests = new HttpRequestsController;
        $locations = $requests->getLocationsByDay($imei, $date);
        
        //Dibujar lineas de union entre ubicaciones
        $polyline['points'] = CustomMap::parseToPoints($locations);
        //Dibujar marcadores en el mapa para cada ubicacion
        for($i = 0; $i < count($locations); $i++){
            $markers[$i]['position'] = $locations[$i]->latitud.','.$locations[$i]->longitud;
            $markers[$i]['infowindow_content'] = '<p>'.$locations[$i]->hora.'</p>';
            $this->gmap->add_marker($markers[$i]);
        }

        $this->gmap->initialize(CustomMap::CONFIG);
        $this->gmap->add_polyline($polyline);

        $map = $this->gmap->create_map();

        $data['map'] = $map;
        $data['locations'] = $locations;
        //Si no hay ubicaciones enviar mensaje en msg
        if(count($locations) == 0){
            $msg = "There are no locations for this day.";
            $data['msg'] = $msg;
        }
        return view('routes')->with('data', $data);
    }

    public function search($date){
        return null;
    }
}
