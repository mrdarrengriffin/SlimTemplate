<?php

namespace MrDarrenGriffin\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

Class User extends Eloquent
{
	protected $table = 'users';
	public $timestamps = false;
	protected $fillable = [
		'username',
		'first_name',
		'last_name',
		'password',
		'active',
		'active_hash',
		'recovery_hash',
		'remember_identifier',
		'remember_token',
		'is_banned',
		'email',
		'attributes',
		'permissions',
		'created_at',
		'updated_at',
	];

	public function getFullName(){
		if(!$this->first_name || !$this->last_name){
			return null;
		}else{
			return "{$this->first_name} {$this->last_name}";
		}
	}

	public function getFullNameOrUsername(){
		return $this->getFullName() ?: $this->username;
	}

	public function activateAccount(){
		$this->update([
			'active' => true,
			'updated_at' => time(),
			'active_hash' => null
		]);
	}

	public function updateAttribute($attribute,$value){

		$currentAttributes = json_decode($this->attributes['attributes'],true);
		unset($currentAttributes[$attribute]);
		$currentAttributes[$attribute] = $value;
		$newAttributes = json_encode($currentAttributes,true);
		$this->update([
			'attributes' => $newAttributes,
			'updated_at' => time(),
		]);
	}
	public function deleteAttribute($attribute){
		$currentAttributes = json_decode($this->attributes['attributes'],true);
		unset($currentAttributes[$attribute]);
		$this->update([
			'attributes' => json_encode($currentAttributes,true),
			'updated_at' => time(),
		]);
	}

	public function getAvatarUrl($options = []){
		$size = isset($options['size']) ? $options['size'] : 45;
		return 'http://www.gravatar.com/avatar/'.md5($this->email).'?s='.$size.'&d=identicon';
	}

	public function updateRememberCredentials($identifier,$token){
		$this->update([
			'remember_identifier' => $identifier,
			'remember_token' => $token
		]);
	}

	public function removeRememberCredentials(){
		$this->updateRememberCredentials(null,null);
	}

	public function hasPermission($permission){
		$permissionsJSON = json_decode($this->permissions,true);
		if(isset($permissionsJSON[$permission]) AND $permissionsJSON[$permission] == "true"){return true; }
		return false;
	}
	public function getAttributeByName($attribute){
		$attributes = json_decode($this->attributes['attributes'],true);
		if(isset($attributes[$attribute])){return $attributes[$attribute]; }
		return false;
	}


}
