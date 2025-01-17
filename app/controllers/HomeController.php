<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends BaseController
{

	public function index()
	{
		return Redirect::route('search');
	}

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

	public function api404()
	{
		return $this->returnError('NO_SUCH_API_METHOD');
	}

}
