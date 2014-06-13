<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;
class User extends ConfideUser implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
use HasRole;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 public static $rules = array(
        'email' => 'required|email|unique:users,email',
        'password' => 'required|between:4,11|confirmed',
        'username' => 'required|alpha_num',
        'fname' => 'required|alpha_dash',
        'lname' => 'required|alpha_dash',


    );
	 
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
