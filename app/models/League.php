<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class League extends Eloquent
{

  use SoftDeletingTrait;

	protected $table = 'leagues';
  protected $hidden = ['deleted_at'];

  public function users()
  {
    return $this->belongsToMany('User');
  }

  public function author()
  {
    return $this->belongsTo('User', 'author_id');
  }

  public function games()
  {
    return $this->hasMany('Game');
  }

}
