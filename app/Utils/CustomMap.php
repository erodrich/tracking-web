<?php

namespace App\Utils;


class CustomMap
{
    const CONFIG = [
        'center' => 'lima, Peru',
        'zoom' => 'auto',
        'map_height' => '500px',

    ];

    public static function parseToPoints($locations){
        $points = array();
        if(count($locations > 0)){
            foreach($locations as $location){
                $points[] = $location->latitud.','.$location->longitud;
            }
        } 
        return $points;
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
