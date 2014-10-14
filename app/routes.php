<?php
Route::get('/', ['uses' => 'HomeController@index']);
Route::get('/home', ['uses' => 'LeaguesController@search', 'as' => 'search']);
Route::post('/home', ['uses' => 'LeaguesController@postSearch']);

Route::get('/league/{slug}', ['uses' => 'LeaguesController@league', 'as' => 'league']);


Route::api(['version' => 'v1', 'prefix' => 'api'], function()
  {

    Route::get('users/all', ['uses' => 'UsersController@all']);
    Route::get('users/view', ['uses' => 'UsersController@view']);
    Route::post('users/add', ['uses' => 'UsersController@add']);
    Route::post('users/login', ['uses' => 'UsersController@login']);

    Route::get('games/all', ['uses' => 'GamesController@all']);
    Route::get('games/view', ['uses' => 'GamesController@view']);
    Route::post('games/add', ['uses' => 'GamesController@add']);

    Route::get('leagues/exists', ['uses' => 'UsersController@all']);
    Route::post('leagues/join', ['uses' => 'UsersController@join']);
    Route::post('leagues/leave', ['uses' => 'UsersController@leave']);

  }
);
