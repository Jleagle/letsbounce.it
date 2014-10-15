<?php
Route::get('/', ['uses' => 'HomeController@index']);
Route::get('/home', ['uses' => 'HomeController@search', 'as' => 'search']);
Route::post('/home', ['uses' => 'HomeController@postSearch']);
Route::get('/league/{slug}', ['uses' => 'HomeController@league', 'as' => 'league']);

Route::api(['version' => 'v1', 'prefix' => 'api'], function()
  {

    Route::get('users/all', ['uses' => 'UsersController@getAll']);
    Route::get('users/view', ['uses' => 'UsersController@getView']);
    Route::post('users/add', ['uses' => 'UsersController@postAdd']);
    Route::post('users/login', ['uses' => 'UsersController@postLogin']);

    Route::get('games/all', ['uses' => 'GamesController@getAll']);
    Route::get('games/view', ['uses' => 'GamesController@getView']);
    Route::post('games/add', ['uses' => 'GamesController@postAdd']);

    Route::get('leagues/view', ['uses' => 'LeaguesController@getView']);
    Route::get('leagues/search', ['uses' => 'LeaguesController@getSearch']);
    Route::post('leagues/join', ['uses' => 'LeaguesController@postJoin']);
    Route::post('leagues/leave', ['uses' => 'LeaguesController@postLeave']);

  }
);
