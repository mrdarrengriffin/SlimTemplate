<?php
namespace MrDarrenGriffin\Cache;
Class Cache{

  public $cacheDirectory = '';
  public $controller = '';

  public function __construct($cacheDirectory, $controller){
    $this->cacheDirectory = rtrim($cacheDirectory,'/').'/';
    $this->controller = rtrim($controller,'/').'/';
    if(!is_dir($this->cacheDirectory.$this->controller)){mkdir($this->cacheDirectory.$this->controller,0777,true);}
  }

  public function store($url,$filename){
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
