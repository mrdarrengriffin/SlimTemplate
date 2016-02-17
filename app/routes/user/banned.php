<?php

$app->get('/banned',function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

if($app->auth->is_banned != 1){$app->response->redirect($app->urlFor('home'));}
  $app->render('user/banned.php');
})->name('banned');
