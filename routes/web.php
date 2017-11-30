<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'ConfigController@index');


// IMAP settings
Route::prefix('imap')->group(function() {

  // Server configuration including protocol, domain, port etc
  Route::get('/config', 'ConfigController@getConfig');

  Route::get('/config/{id}', 'ConfigController@getConfigById');
  
  Route::post('/add', 'ConfigController@add');
  
  Route::post('/edit', 'ConfigController@edit');
  
  Route::delete('/delete/{id}', 'ConfigController@delete');
  
});

Route::prefix("history")->group(function() {

  Route::get('/', 'HistoryController@index');

  Route::get('/filter/{item}', 'HistoryController@getHistoryByItems');

  Route::get('/{id}', 'HistoryController@getHistoryById');

});

Route::prefix("contents")->group(function() {
  // Email settings with Tasks
  Route::get('/', 'MailBoxController@index');

  Route::get('/mailbox/list/{id}', 'MailBoxController@getListOfMailbox');

  Route::post('/mailbox/create', 'MailBoxController@createMailbox');

  Route::post('/move', 'MailBoxController@moveTo');

  Route::post('/read', 'MailBoxController@markAsRead');

  Route::post('/unread', 'MailBoxController@markAsUnread');

  Route::post('/mail/delete', 'MailBoxController@deleteEmail');

  Route::post('/mailbox/delete', 'MailBoxController@deleteMailbox');

  Route::get('/{id}', 'MailBoxController@getEmailContentById');
});

Route::prefix('task')->group(function() {
  
  Route::get('/', 'TaskController@index');

  Route::get('/task/{id}', 'TaskController@getTaskById');
  
  Route::post('/add', 'TaskController@add');
  
  Route::post('/edit', 'TaskController@edit');
  
  Route::delete('/delete/{id}', 'TaskController@delete');

});

// Summary page with the email
Route::get('/summary', 'SummaryController@index');

// User route
Route::prefix('user')->group(function() {

  Route::get('/update', 'UserController@Update');

  Route::get('/roles', 'UserController@getRoles');

  Route::get('/profile', 'UserController@getUserProfile');
});

