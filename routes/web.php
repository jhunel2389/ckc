<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/toolsProficiency', 'ReportController@toolsProficiency');
Route::get('/trainingStatus', 'ReportController@trainingStatus');

Route::get('/profile', 'ProfileController@profile')->name('profile');
//Route::get('/userProfile', 'ProfileController@userProfile')->name('userProfile');
Route::get('/userProfile/{id}', 'ProfileController@userProfile')->name('userProfile');
// Route::resource('userProfile', 'ProfileController', ['parameters' => [
//     'userProfile' => 'id'
// ]]);

Route::post('/editProfile', 'ProfileController@edit')->name('editProfile');

Route::get('/systemUsers', 'SystemController@users')->name('systemUsers');
Route::get('/systemTeams', 'SystemController@teams')->name('systemTeams');
Route::post('/addTeams', 'SystemController@addTeams')->name('addTeams');
Route::post('/updateTeam', 'SystemController@updateTeam')->name('updateTeam');

Route::get('/systemEmployeeRoles', 'SystemController@employeeRoles')->name('systemEmployeeRoles');
Route::post('/addEmployeeRoles', 'SystemController@addEmployeeRoles')->name('addEmployeeRoles');
Route::post('/updateEmployeeRoles', 'SystemController@updateEmployeeRoles')->name('updateEmployeeRoles');

Route::get('/systemTools', 'SystemController@tools')->name('systemTools');
Route::post('/addTool', 'SystemController@addTool')->name('addTool');
Route::post('/updateTool', 'SystemController@updateTool')->name('updateTool');
Route::get('/getTools', 'SystemController@getTools')->name('getTools');


Route::get('get-primary-tools-data', 'SystemController@primaryToolsData')->name('datatables.primary-tools');
Route::get('get-secondary-tools-data', 'SystemController@secondaryToolsData')->name('datatables.secondary-tools');
Route::post('add-er-tools-data', 'SystemController@addERToolsData')->name('ajax.add-er-tools');