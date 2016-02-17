<?php
	
	namespace MrDarrenGriffin\Validation;
	
	use Violin\Violin;
	use MrDarrenGriffin\User\User;
	use MrDarrenGriffin\Helpers\Hash;
	
	class Validator extends Violin{
		
		protected $user;
		protected $hash;
		protected $auth;
		
		public function __construct(User $user, Hash $hash,$auth = null){
			$this->user = $user;
			$this->hash = $hash;
			$this->auth = $auth;
			
			$this->addFieldMessages([
			'email' => [
			'uniqueEmail' => "Email already in use."
			],
			'username' => [
			'uniqueUsername' => "Username already in use."
			],
			'password' => [
			'min' => "Password must be more than 6 characters"
			],
			'new_password' => [
			'min' => "Password must be more than 6 characters"
			],
			'new_password_confirm' => [
			'min' => "Password must be more than 6 characters"
			],
			]);
			
			$this->addRuleMessages([
			'matchesCurrentPassword' => 'Current password incorrect.',
			'required' => "This is required"
			
			]);
		}
		
		public function validate_uniqueEmail($value,$input,$args){
			
			$user = $this->user->where('email',$value);
			
			if($this->auth && $this->auth->email === $value){
				return true;
			}
			return ! (bool) $user->count();
			
		}
		
		public function validate_uniqueUsername($value,$input,$args){
			
			return ! (bool) $this->user->where('username',$value)->count();
			
		}
		
		public function validate_matchesCurrentPassword($value,$input,$args){
			if($this->auth && $this->hash->passwordCheck($value,$this->auth->password)){
				return true;
			}
			
			return false;
		}
	}
