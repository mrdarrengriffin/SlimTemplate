<?php
	
	$app->get('/logout',function() use ($app){
		
		unset($_SESSION[$app->config->get('auth.session')]);
		
		if($app->getCookie($app->config->get('auth.remember'))){
			$app->auth->removeRememberCredentials();
			$app->deleteCookie($app->getCookie($app->config->get('auth.remember')));
		}
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$app->flash('success','You have been logged out.');
		$app->response->redirect($app->urlFor('login'));
		
	})->name('logout');
