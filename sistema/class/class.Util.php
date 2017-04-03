<?php

class Util {

	public static function toJson($info) {
		header('Content-type: application/json');
		return json_encode($info);
	}
	
	public static function formatDate($data, $formato = "d/m/Y") {
		return date($formato, strtotime($data));
	}
	
	public static function convertDate($data) {
		list($dia, $mes, $ano) = explode("/", $data);
		return sprintf("%s-%s-%s", $ano, $mes, $dia);
	}
}