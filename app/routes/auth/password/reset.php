<?php
	
	$app->get('/password_reset',$guest(),function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$request = $app->request();
		
		$email = $request->get('email');
		$identifier = $request->get('identifier');
		
		$hashedIdentifier = $app->hash->hash($identifier);
		$user = $app->user->where('email',$email)->first();
		
		if(!$user){
			$app->response->redirect($app->urlFor('home'));
		}
		if(!$user->recovery_hash){
			$app->response->redirect($app->urlFor('home'));
		}
		
		if(!$app->hash->hashCheck($user->recovery_hash,$hashedIdentifier)){
			$app->response->redirect($app->urlFor('home'));
		}
		
		$app->render('auth/password/reset.php',[
		'email' => $user->email,
		'identifier' => $identifier
		]);
		
		
	})->name("password.reset");
	
	$app->post('/password_reset',$guest(),function() use($app){
		
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$request = $app->request();
		
		$email = $request->get('email');
		$identifier = $request->get('identifier');
		
		$password = $request->post('new_password');
		$passwordConfirm = $request->post('new_password_confirm');
		
		$hashedIdentifier = $app->hash->hash($identifier);
		$user = $app->user->where('email',$email)->first();
		
		if(!$user){
			$app->response->redirect($app->urlFor('home'));
		}
		if(!$user->recovery_hash){
			$app->response->redirect($app->urlFor('home'));
		}
		
		if(!$app->hash->hashCheck($user->recovery_hash,$hashedIdentifier)){
			$app->response->redirect($app->urlFor('home'));
		}
		
		$v = $app->validation;
		
		$v->validate([
		'new_password' => [$password,'required|min(6)'],
		'new_password_confirm' => [$password,'required|matches(new_password)']
		]);
		
		if($v->passes()){
			$user->update([
			'password' => $app->hash->password($password),
			'recovery_hash' => null
			]);
			
			$app->flash('success','Password reset sucessful.');
			$app->response->redirect($app->urlFor('home'));
			}else{
			$app->render('auth/password/reset.php',[
			'errors' => $v->errors()
		]);
		}
		
		})->name('password.reset.post');
				