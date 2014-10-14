<?php
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsersController extends BaseController
{

	public function postAdd()
	{
		$key = $this->_makeApiKey();
	}

	public function all()
	{
		$user = $this->_checkApiKey();
		$data = Input::all();

		if (!isset($data['league_id']) || !is_numeric($data['league_id']))
		{
			throw new NotFoundHttpException('Incorrect league_id value');
		}

		$users = LeagueUser
			::join('users', 'users.id', '=', 'league_user.user_id')
			->where('league_id', '=', $data['league_id'])
			->get(['user_id', 'name']);

		return $users->toArray();
	}

	public function view()
	{
		// todo - get expected result with this user.

		$user = $this->_checkApiKey();
		$data = Input::all();

		if (isset($data['user_id']) && !is_numeric($data['user_id']))
		{
			throw new NotFoundHttpException('Incorrect user_id value');
		}

		if (!isset($data['user_id']))
		{
			$data['user_id'] = $user->id;
		}

		return User::select('name', 'email', 'created_at')->find($data['user_id'])->toArray();
	}

	private function _makeApiKey()
	{

		while(true)
		{
			$key = md5(uniqid(rand(), true));
			$user = User::where('api_key', '=', $key);
			if (is_null($user))
			{
				return $key;
			}
		}

	}

}
