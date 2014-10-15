<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface
{

  use UserTrait;
  use SoftDeletingTrait;

	protected $table = 'users';
	protected $hidden = ['password', 'deleted_at'];
  protected $fillable = ['name', 'email', 'password', 'api_key'];

  public function games()
  {
    return $this->hasMany('Game');
  }

  public function leagues()
  {
    return $this
      ->belongsToMany('League')
      ->withTimestamps();
  }

}
