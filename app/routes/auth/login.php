<?php

use Carbon\Carbon;

$app->get('/login', $guest(), function() use ($app){
	if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
	$app->render("auth/login.php");
})->name('login');

$app->post('/login', $guest(),function() use ($app){
	if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

	$request = $app->request;

	$username = $request->post('username');
	$password = $request->post('password');
	$remember = $request->post('remember');

	$v = $app->validation;

	$v->validate([
		'username' => [$username,'required'],
		'password' => [$password,'required']
		]);

	if($v->passes()){
		$user = $app->user->where('username',$username)->where('active',true)->first();

		if($user && $app->hash->passwordCheck($password,$user->password)){
			$_SESSION[$app->config->get('auth.session')] = $user->id;

			if($remember === 'on'){
				$rememberIdentifier = $app->randomlib->generateString(128);
				$rememberToken = $app->randomlib->generateString(128);

				$user->updateRememberCredentials($rememberIdentifier,$app->hash->hash($rememberToken));

				$app->setCookie(
					$app->config->get('auth.remember'),
					"{$rememberIdentifier}___{$rememberToken}",
					Carbon::parse("+1 week")->timestamp
					);
			}

			if($user->getAttributeByName('first_login') == "true"){
				$user->updateAttribute('first_login',false);
				$app->flash('success',"Welcome, <strong>$user->username</strong>, to ".$app->config->get('app.name').".");
			}else{
				$app->flash('success',"Welcome back <strong>$user->username</strong>!");
			}

			if($user->require_new_password == "1"){$app->response->redirect($app->urlFor('new-password'));}else{
				$app->response->redirect($app->urlFor('home'));
			}
		}else{
			$app->flash('warning',"Incorrect username and/or password.");
			$app->response->redirect($app->urlFor('login'));
		}

	}


	$app->render('auth/login.php',[
		'errors' => $v->errors(),
		'request' => $request
		]);

})->name('login.post');
