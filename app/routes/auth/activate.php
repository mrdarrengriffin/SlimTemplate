<?php
	
	$app->get('/activate',function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$request = $app->request;
		
		$email = $request->get('email');
		$identifier = $request->get('identifier');
		
		$hashedIdentifier = $app->hash->hash($identifier);
		
		$user = $app->user->where('email',$email)->where('active',false)->first();
		
		if(!$user || !$app->hash->hashCheck($user->active_hash,$hashedIdentifier)){
			$app->flash('error','There was a problem activating your account.');
			$app->response->redirect($app->urlFor('home'));
			}else{
			$app->flash('success','Account activated! You may now sign in.');
			$app->response->redirect($app->urlFor('home'));
			$user->activateAccount();
		}
	})->name('activate');
