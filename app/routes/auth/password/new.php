<?php
$app->get('/new-password',function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

if($app->auth->require_new_password == 0){$app->redirect($app->urlFor('home'));}

$app->render('auth/password/new.php');
  })->name('new-password');

$app->post('/new-password', $authenticated(),  function() use ($app){
		if($app->config->get('auth.enabled') == false){$app->response->redirect($app->urlFor('home'));}

  $request = $app->request;

  $passwordNew = $request->post('new_password');
  $passwordNewConfirm = $request->post('new_password_confirm');

  $v = $app->validation;

  $v->validate([
    'new_password' => [$passwordNew,'required|min(6)'],
    'new_password_confirm' => [$passwordNewConfirm,'required|matches(new_password)']
    ]);

    if($v->passes()){

      $user = $app->auth;

      $app->auth->update([
        'password' => $app->hash->password($passwordNew),
        'require_new_password' => "0"
        ]);

        $app->mail->send('email/auth/password/change.php',[],function($message) use ($user){
          $message->to($user->email);
          $message->subject('Password changed');
        });

        $app->flash('success','Password changed successfully.');
        $app->response->redirect($app->urlFor('home'));
    }

    $app->render('/auth/password/new.php',[
      'errors' => $v->errors(),
      'request' => $request
      ]);

})->name('account.newPassword.post');
