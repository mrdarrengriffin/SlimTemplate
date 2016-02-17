<?php

namespace MrDarrenGriffin\Helpers;

Class LiterateHelper{


	public function upperFirst($input){
		return ucfirst(trim($this->lowerAll($input)));
	}

	public function upperWords($input){
		return ucwords(trim($this->lowerAll($input)));
	}

	public function lowerAll($input){
		return strtolower($input);
	}

	public function upperAll($input){
		return strtoupper($input);
	}
}
