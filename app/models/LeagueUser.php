<?php
use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class LeagueUser extends Eloquent
{

  use SoftDeletingTrait;

  protected $table = 'league_user';

  public function league()
  {
    return $this->belongsTo('League');
  }

  public function user()
  {
    return $this->belongsTo('User');
  }

}
