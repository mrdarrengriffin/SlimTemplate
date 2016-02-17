<?php

$app->get('/account/change_password', $authenticated(), function() use ($app){
	if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

	$app->render('auth/password/change.php');
})->name('account.changePassword');

$app->post('/account/change_password', $authenticated(),  function() use ($app){
	if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

	$request = $app->request;

	$passwordOld = $request->post('current_password');
	$passwordNew = $request->post('new_password');
	$passwordNewConfirm = $request->post('new_password_confirm');

	$v = $app->validation;

	$v->validate([
		'current_password' => [$passwordOld,'required|matchesCurrentPassword'],
		'new_password' => [$passwordNew,'required|min(6)'],
		'new_password_confirm' => [$passwordNewConfirm,'required|matches(new_password)']
	]);

	if($v->passes()){

		$user = $app->auth;

		$app->auth->update([
			'password' => $app->hash->password($passwordNew)
		]);

		$app->mail->send('email/auth/password/change.php',[],function($message) use ($user){
			$message->to($user->email);
			$message->subject('Password changed');
		});

		$app->flash('success','Password changed successfully.');
		$app->response->redirect($app->urlFor('home'));
	}

	$app->render('auth/password/change.php',['errors' => $v->errors()]);

})->name('account.changePassword.post');
