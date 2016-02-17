<?php

namespace MrDarrenGriffin\Middleware;

use Slim\Middleware;

class BeforeMiddleware extends Middleware{
	
	public function call(){
		$this->app->hook('slim.before.dispatch', array($this, 'onBeforeDispatch'));
		$this->app->hook('slim.before',[$this,'run']);
		
		$this->next->call();
	}
	
	public function run(){

		if(isset( $_SESSION[$this->app->config->get('auth.session')] )){
			$this->app->auth = $this->app->user->where('id',$_SESSION[$this->app->config->get('auth.session')] )->first();
		}
		if($this->app->config->get('maintenance.enabled') == true AND !in_array($_SERVER['REMOTE_ADDR'],$this->app->config->get('maintenance.allowed_ips'))){
			die("IP not authorized");
		}
		
		if($this->app->config->get('auth.enabled')){
			$this->checkRememberMe();
			$this->app->view()->appendData([
				'auth' => $this->app->auth,
				'authEnabled' => $this->app->config->get('auth.enabled'),
				'base_url' => $this->app->config->get('app.url'),
				'current_route' => $this->app->request()->getPath(),
				'application_name' => $this->app->config->get('app.name'),
				'config' => $this->app->config,
				]);


		}else{
			$this->app->view()->appendData([
				'base_url' => $this->app->config->get('app.url'),
				'current_route' => $this->app->request()->getPath(),
				'application_name' => $this->app->config->get('app.name'),
				'config' => $this->app->config,
				]);
		}		
	}
	public function onBeforeDispatch()
	{
		$this->app->view()->appendData([
			'route_name' => $this->app->router()->getCurrentRoute()->getName()
			]);		
	}
	protected function checkRememberMe(){
		if($this->app->getCookie($this->app->config->get('auth.remember')) && !$this->app->auth) {
			$data = $this->app->getCookie($this->app->config->get('auth.remember'));
			$credentials = explode('___',$data);
			if(empty(trim($data)) || count($credentials) !== 2){
				$this->app->response->redirect($this->app->urlFor('home'));
			}else{
				$identifier = $credentials[0];
				$token = $this->app->hash->hash($credentials[1]);
				
				$user = $this->app->user
				->where('remember_identifier',$identifier)
				->first();
				
				if($user){
					if($this->app->hash->hashCheck($token,$user->remember_token)){
						$_SESSION[$this->app->config->get('auth.session')] = $user->id;
						$this->app->auth = $this->app->user->where('id',$user->id)->first();
					}else{
						$user->removeRememberCredentials();
					}
				}
			}
			
		}
	}
}
