<?php
	
	$app->get('/manage/users',$requirePermission("admin.users.view"), function() use ($app){
		if(!$app->auth){$app->notFound();}
		$users = new MrDarrenGriffin\User\User;
		
		$app->render('manage/users.php',['allUsers' => $users->with('permissions')->get()]);
		
	})->name('admin.users');
	
	$app->get('/manage/user/:id',$requirePermission("admin.user.view"), function($id) use ($app){
		if(!$app->auth){$app->notFound();}
		$users = new MrDarrenGriffin\User\User;
		$app->render('manage/user.php',['user' => $users->with('permissions')->where('id',$id)->first()]);
		
	})->name('admin.user');
	
	$app->post('/manage/user',$requirePermission("admin.user.update"), function() use ($app){
		if(!$app->auth){$app->notFound();}
		$request = $app->request();
		$user = MrDarrenGriffin\User\User::where('id',$request->post('id'))->first();
		$user->first_name = $request->post('fname');
		$user->last_name = $request->post('lname');
		$user->username = $request->post('username');
		if($request->post('new_password') != null){
			$user->password = $app->hash->password($request->post('new_password'));
		}
		$user->email = $request->post('email');
		$user->is_banned = $request->post('banned')?:0;
		$user->active = $request->post('active')?:0;
		$user->require_new_password = $request->post('require_password')?:0;
		$user->save();
		$app->flash('success','User Updated');
		$app->response->redirect($app->urlFor('admin.users'));
	})->name('admin.user.update');
	
	$app->post('/manage/user/permission/add',$requirePermission("admin.user.permissions.add"), function() use ($app){
		if(!$app->auth){$app->notFound();}
		$request = $app->request();
		$user = MrDarrenGriffin\User\UserPermission::where('user_id',$request->post('user_id'))->first();
		$permissions = json_decode($user->permissions,true);
		$permissions[$request->post('permission_node')] = true;
		$user->permissions = json_encode($permissions);
		$user->save();
		$app->response->redirect($app->urlFor('admin.user',['id' => $request->post('user_id')]));
	})->name('admin.user.permissions.add');
	$app->post('/manage/user/permission/delete',$requirePermission("admin.user.permissions.delete"), function() use ($app){
		if(!$app->auth){$app->notFound();}
		$request = $app->request();
		$user = MrDarrenGriffin\User\UserPermission::where('user_id',$request->post('user_id'))->first();
		$permissions = json_decode($user->permissions,true);
		unset($permissions[$request->post('permission_node')]);
		$user->permissions = json_encode($permissions);
		$user->save();
		$app->response->redirect($app->urlFor('admin.user',['id' => $request->post('user_id')]));
	})->name('admin.user.permissions.delete');
