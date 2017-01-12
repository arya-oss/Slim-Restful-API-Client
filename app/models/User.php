<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
  /**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'friends';
	/**
   * timestamps table not present
   */
	public $timestamps = false;
	protected $fillable = ['rollno', 'name', 'email', 'phone', 'company',];
}
