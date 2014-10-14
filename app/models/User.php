<?php
class User extends Eloquent
{

	protected $table = 'users';
	protected $hidden = ['password'];
  protected $fillable = ['name', 'email', 'password', 'api_key'];

  public function games()
  {
    return $this->hasMany('Game');
  }

  public function groupUsers()
  {
    return $this->hasMany('GroupUser');
  }

}
