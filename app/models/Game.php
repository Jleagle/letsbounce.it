<?php
class Game extends Eloquent
{

  protected $table = 'games';

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
