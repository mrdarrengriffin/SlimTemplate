<?php

Class Cache{

  public $cacheDirectory = '';
  public $controller = '';

  public function __construct($cacheDirectory, $controller){
    $this->cacheDirectory = rtrim($cacheDirectory,['/','\/']).'/';
    $this->controller = rtrim($controller,['/','\/']).'/';
  }

  public function storeImage($url,$filename){
    return copy($url,$this->cacheDirectory.$this->controller.$filename);
  }

  public function retrieve($filename){
    return $this->cacheDirectory.$this->controller.$filename;
  }

  public function isInCache($filename){
   return file_exists($this->cacheDirectory.$this->controller.$filename);
  }

  public function remove($filename){
    return delete($this->cacheDirectory.$this->controller.$filename);
  }

}
