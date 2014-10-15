<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Game extends Eloquent
{

  use SoftDeletingTrait;

  protected $table = 'games';
  protected $hidden = ['password', 'deleted_at'];

  public function winner()
  {
    return $this->belongsTo('User', 'winner_id');
  }

  public function loser()
  {
    return $this->belongsTo('User', 'loser_id');
  }

  public function author()
  {
    return $this->belongsTo('User', 'author_id');
  }

  public function league()
  {
    return $this->belongsTo('League');
  }

}
