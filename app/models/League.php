<?php
class League extends Eloquent
{

	protected $table = 'leagues';

  public function users()
  {
    return $this->hasMany('GroupUser');
  }

  public function owner()
  {
    return $this->belongsTo('User', 'author_id');
  }

  public function games()
  {
    return $this->hasMany('Game');
  }

}
