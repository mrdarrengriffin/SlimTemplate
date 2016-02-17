<?php

namespace MrDarrenGriffin\Blog;

use Illuminate\Database\Eloquent\Model as Eloquent;

Class Blog extends Eloquent
{
	protected $table = 'blg';
	public $timestamps = false;
	protected $fillable = [
		'user_id',
    'title',
    'content',
    'timestamp_created',
	];


}