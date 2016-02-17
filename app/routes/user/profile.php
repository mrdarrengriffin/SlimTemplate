<?php

$app->get('/user/:username',function($username) use ($app){
	if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

	$user = $app->user->where('username',$username)->first();

	if(!$user){
		$app->notFound();
	}

	$app->render('user/profile.php',['user' => $user]);

})->name('user.profile');
