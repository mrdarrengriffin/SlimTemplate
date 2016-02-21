<?php

namespace MrDarrenGriffin\Blog;

use Illuminate\Database\Eloquent\Model as Eloquent;

Class Blog extends Eloquent
{
	protected $table = 'blog';
	public $timestamps = false;
	protected $fillable = [
		'user_id',
    'title',
    'content',
    'timestamp_created',
		'attributes',
		'enabled',
	];

  public function user(){
    return $this->hasOne('MrDarrenGriffin\User\User','id','user_id');
  }

	public function getAttributeByName($attribute){
		$attributes = json_decode($this->attributes['attributes'],true);
		if(isset($attributes[$attribute])){return $attributes[$attribute]; }
		return false;
	}

}
