<?php

namespace MrDarrenGriffin\Helpers;

Class RouteHelper{

public function ifOnRoute($routePath){
  if($this->request()->getPath() == $routePath){
    return true;
  }
  return false;
}

}
