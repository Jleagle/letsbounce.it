<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LeaguesController extends BaseController
{

	public function search()
	{
		return View::make('home');
	}

	public function postSearch()
	{
		$data = Input::all();

		try
		{
			$league = League::where('name', '=', $data['name'])->firstOrFail();
		}
		catch(ModelNotFoundException $e)
		{
			return Redirect::route('search')->withErrors(['error' => 'Not Found'])->withInput($data);
		}

		return Redirect::route('league', $league->slug);
	}

	public function league($slug)
	{
		$league = League::where('slug', '=', $slug)->firstOrFail();

		return View::make('league', ['league' => $league]);
	}

	public function leagueExists($leagueName)
	{
		//
	}

	public function joinLeague($leagueId)
	{
		//
	}

}
