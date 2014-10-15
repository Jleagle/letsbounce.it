<?php
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UsersController extends BaseController
{

	public function getAll()
	{
		$user = $this->_checkApiKey();
		$data = Input::only(['league_id']);

		$rules = [
			'league_id' => 'required|integer|exists:leagues,id',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			return User
				::whereHas('leagues', function($q) use($data)
				{
					$q->where('league_id', '=', $data['league_id']);

				})
				->select(['id', 'name'])
				->get()
				->toArray();
		}

		return $this->returnError($validator);
	}

	// todo - get expected result with this user.
	// todo - ask for league too, make sure both users are in the league
	public function getView()
	{
		$user = $this->_checkApiKey();
		$data = Input::only(['user_id']);

		if (!isset($data['user_id']))
		{
			$data['user_id'] = $user->id;
		}

		$rules = [
			'user_id' => 'required|integer|exists:users,id',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			return User
				::find($data['user_id'])
				->select(['id', 'name', 'email'])
				->get()
				->first()
				->toArray();
		}

		return $this->returnError($validator);
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
				'id'      => $user->id,
				'api_key' => $user->api_key
			];
		}

		return $this->returnError($validator);
	}

	public function postLogin()
	{
		$data = Input::only('email', 'password');

		$rules = [
			'email'    => 'required',
			'password' => 'required',
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes())
		{
			if (Auth::attempt($data))
			{
				return User
					::where('email', '=', $data['email'])
					->first()
					->toArray();
			}

			throw new ConflictHttpException('Invalid details');
		}

		return $this->returnError($validator);
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
