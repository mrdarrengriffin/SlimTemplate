<?php

$app->get('/users', function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

  $users = $app->user->where('active',true)->get();

  $app->render('user/all.php',['users' => $users]);

})->name('users.all');
