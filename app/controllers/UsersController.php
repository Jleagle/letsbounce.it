<?php
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsersController extends BaseController
{

	public function getAll()
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

	public function getView()
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

	public function postAdd()
	{
		$data = Input::all();

		$rules = [
			'name'     => 'required',
			'email'    => 'required|email|unique:users,email',
			'password' => 'required',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			$user = User::create([
					'name' => $data['name'],
					'email' => $data['email'],
					'password' => Hash::make($data['password']),
					'api_key' => $this->_makeApiKey()
				]);

			return [
				'api_key' => $user->api_key
			];
		}

		return $validator->messages();
	}

	public function postLogin()
	{
		$data = Input::all();

		$rules = [
			'email'    => 'required',
			'password' => 'required',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{

			if ($x = Auth::attempt(array('email' => $data['email'], 'password' => $data['password'])))
			{
				return User::select('name', 'api_key')->where('email', '=', $data['email'])->first();
			}

			throw new ConflictHttpException('Invalid details');
		}

		return $validator->messages();
	}

	private function _makeApiKey()
	{

		while(true)
		{
			$key = md5(uniqid(rand(), true));
			$user = User::where('api_key', '=', $key)->first();
			if (is_null($user))
			{
				return $key;
			}
		}

	}

	public function _makePassword()
	{
		// todo, email password to them
		return 'password';
	}

}
