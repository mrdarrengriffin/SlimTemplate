<?php
	
	$app->get('/forgot_password', $guest(), function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$app->render('auth/password/recover.php');
	})->name('password.recover');
	
	$app->post('/forgot_password', $guest(), function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$request = $app->request;
		
		$email = $request->post('email');
		
		$v = $app->validation;
		
		$v->validate([
		'email' => [$email,'required|email']
		]);
		
		if($v->passes()){
			$user = $app->user->where('email',$email)->first();
			
			if(!$user){
				$app->flash('global_red','Email not found');
				$app->response->redirect($app->urlFor('password.recover'));
				}else{
				
				$identifier = $app->randomlib->generateString(128);
				
				$user->update([
				'recover_hash' => $app->hash->hash($identifier)
				]);
				
				$app->mail->send('email/auth/password/recover.php',['user' => $user,'identifier' => $identifier], function($message) use ($user){
					$message->to($user->email);
					$message->subject("Password recovery");
				});
				
				$app->flash('warning','Please check your email for instructions');
				
			}
			
			$app->response->redirect($app->urlFor('home'));
		}
		
		$app->render('auth/password/recover.php',[
		'errors' => $v->errors(),
		'request' => $request
		]);
		
	})->name('password.recover.post');
