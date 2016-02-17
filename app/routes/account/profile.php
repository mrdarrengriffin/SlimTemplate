<?php
	
	$app->get('/account/profile',$authenticated(), function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$app->render('account/profile.php');
	})->name('account.profile');
	
	$app->post('/account/profile',$authenticated(), function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}
		
		$request = $app->request;
		
		$email = $request->post('email');
		$firstName = $request->post('first_name');
		$lastName = $request->post('last_name');
		
		$v = $app->validation;
		
		$v->validate([
		'email' => [$email,'required|email|uniqueEmail'],
		'first_name' => [$firstName,'alpha|max(50)'],
		'last_name' => [$lastName,'alpha|max(50)'],
		]);
		
		if($v->passes()){
			$app->auth->update([
			'email' => $email,
			'first_name' => $firstName,
			'last_name' => $lastName,
			'updated_at' => time(),
			]);
			
			$app->flash('success','Your details have been updated.');
			$app->response->redirect($app->urlFor('account.profile'));
			}else{
			$app->flash('warning','There was a problem updating your details. The email may already be taken.');
			$app->response->redirect($app->urlFor('account.profile'),[
			'errors' => $v->errors,
			'request' => $request
			]);
		}
	})->name('account.profile.post');
