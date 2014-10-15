<?php
use Illuminate\Database\QueryException;

class LeaguesController extends BaseController
{

	public function getView()
	{
		$user = $this->_checkApiKey();
		$data = Input::only(['league_id']);

		$rules = [
			'league_id' => 'required|integer|exists:leagues,id',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{

			return League
				::where('id', '=', $data['league_id'])
				->select(['id', 'author_id', 'name', 'slug', 'k_factor'])
				->with(array('users' => function($q){
						$q->select('users.id', 'name');
					}))
				->with(array('games' => function($q){
						//$q->select('id', 'name'); // todo
					}))
				->with(array('author' => function($q){
						$q->select('id', 'name');
					}))
				->get()
				->toArray();
		}

		return $this->returnError($validator);
	}

	public function getSearch()
	{
		$user = $this->_checkApiKey();
		$data = Input::only(['league_name']);

		$rules = [
			'league_name' => 'required|exists:leagues,name',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			return League
				::select(['id', 'name', 'slug', 'k_factor'])
				->where('name', '=', $data['league_name'])
				->first()
				->toArray();
		}

		return $this->returnError($validator);
	}

	public function postJoin()
	{
		$user = $this->_checkApiKey();
		$data = Input::only(['league_id']);

		$rules = [
			'league_id' => 'required|integer',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			try
			{
				$league = League::find($data['league_id']);
				$league->users()->attach($user->id);
			}
			catch(QueryException $e)
			{
			}

			return ['success' => true];
		}

		return $this->returnError($validator);
	}

	public function postLeave()
	{
		$user = $this->_checkApiKey();
		$data = Input::only(['league_id']);

		$rules = [
			'league_id' => 'required|integer',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			$league = League::find($data['league_id']);
			$league->users()->detach($user->id);

			return ['success' => true];
		}

		return $this->returnError($validator);
	}

}
