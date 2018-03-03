<?php

namespace App\Utils;


class CustomMap
{
    const CONFIG = [
        'center' => 'lima, Peru',
        'zoom' => '12',
        'map_height' => '500px',
    ];


    public static function parseToPoints($locations){
        $points = array();
        if(count($locations) > 0){
            foreach($locations as $location){
                $points[] = $location->latitud.','.$location->longitud;
            }
        } 
        return $points;
    }
    public static function getCenter($locations){
        $center = '';
        if(count($locations) > 0){
            if(count($locations) == 1){
                $center = $locations[0]->latitud.','.$locations[0]->longitud;
            }
            else{
                //Working latitud
                $minLat = $locations[0]->latitud;
                $maxLat = $locations[0]->latitud;
                for($i = 0; $i < count($locations); $i++){
                    if($locations[$i]->latitud < $minLat){
                        $minLat = $locations[$i]->latitud;
                    }
                    if($locations[$i]->latitud > $maxLat){
                        $maxLat = $locations[$i]->latitud;
                    }
                }
                $centerLat = ($maxLat + $minLat)/2;
                //Working longitud
                $minLng = $locations[0]->longitud;
                $maxLng = $locations[0]->longitud;
                for($i = 0; $i < count($locations); $i++){
                    if($locations[$i]->longitud < $minLat){
                        $minLng = $locations[$i]->longitud;
                    }
                    if($locations[$i]->longitud > $maxLat){
                        $maxLng = $locations[$i]->longitud;
                    }
                }
                $centerLng = ($maxLng + $minLng)/2;
                $center = $centerLat.','.$centerLng;
            }
        }
        else{
            $center = 'Lima, Peru';
        }
        return $center;
    }

    public static function setControls($gmap){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $gmap->injectControlsInTopRight = $topRightControls;

        return $gmap;
    }

    
}
