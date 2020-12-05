<?php

function conPuntosRut( $rut ){
	$rutTmp = explode( "-", $rut );
	return number_format( $rutTmp[0], 0, "", ".") . '-' . $rutTmp[1];
}

function sinPuntosRut( $rut ){
	$rut = str_replace('.', '', $rut);
        $rut = str_replace('-', '', $rut);
	return $rut;
}

function sinPuntosGuionRut( $rut ){
    $rut = str_replace('.', '', $rut);
    $rut = str_replace('-', '', $rut);
    $rut = substr($rut, 0, -1);
    return $rut;
}

