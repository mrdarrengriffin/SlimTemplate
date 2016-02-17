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
	];

  public function user(){
    return $this->hasOne('MrDarrenGriffin\User\User','id','user_id');
  }

}
