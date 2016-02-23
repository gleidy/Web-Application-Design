<?php

class Validation {


	public function isEmailValid($address){
		if (filter_var ($address, FILTER_VALIDATE_EMAIL)){ return true; }
		else return false;
	}

	public function isNumberInRangeValid($num,$min,$max){
		if(is_numeric($num) && is_numeric($min) && is_numeric($max)){
			if($min <= $num && $num <= $max){ return true; }
			else if($num <= $min || $max <= $num){return false; }
		}
		else return false;
	}

	public function isLengthStringValid($string,$maxLength){
		if(strlen($string) <= $maxLength){ return true; }
		else return false;
	}
}


?>