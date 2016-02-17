<?php

$authenticationCheck = function($required) use ($app){
  return function() use ($required,$app){
    if((!$app->auth && $required) || ($app->auth && !$required)){
      $app->redirect($app->urlFor('home'));
    }
  };
};

$permissionCheck = function($node) use ($app){
  return function() use ($node,$app){
    if(!$app->auth OR $app->auth->hasPermission($node) != "true"){
      $app->flash('error',"You do not have the required permission node <strong>".$node."</strong>");
      $app->redirect($app->urlFor('home'));
    }
  };
};

$authenticated = function() use ($authenticationCheck){
  return $authenticationCheck(true);
};

$guest = function() use ($authenticationCheck){
  return $authenticationCheck(false);
};

$requirePermission = function($node) use ($permissionCheck){
  return $permissionCheck($node);
};
