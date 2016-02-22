<?php

namespace MrDarrenGriffin\Minecraft;

use Illuminate\Database\Eloquent\Model as Eloquent;

Class Minecraft extends Eloquent
{
	protected $table = 'minecraft';
	public $timestamps = false;
	protected $fillable = [];

}
