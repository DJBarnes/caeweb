<?php

/*
|------------------------------------------------------------------------------
| Application Routes
|------------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Root Route
Route::get('/', array('as' => 'home', function()
{
	return View::make('pages.tempindex');
}))->before('auth');

// ----------------------------------------------------------------------------
// Redirect Routes for short url
// ----------------------------------------------------------------------------
Route::get('roomschedule', function()
{
  return Redirect::to('roomschedule/classroom');
})->before('auth_room');

Route::get('inventory', function()
{
  return Redirect::to('inventory/currentinventory');
})->before('auth_inv');

Route::get('avlog', function()
{
  return Redirect::to('avlog/classroom');
})->before('auth_avlog');

Route::get('employee', function()
{
  return Redirect::to('employee/myhours');
})->before('auth_emp');

Route::get('useradmin', function()
{
  return Redirect::to('useradmin/userlist');
})->before('auth_useradm');

// ----------------------------------------------------------------------------
// Room schedule routes
// ----------------------------------------------------------------------------
// Routes for the tabs and views
Route::get('roomschedule/classroom', function()
{
  return View::make('layouts.roomschedule')->nest('contentTabHolder','roomschedule.classroomTab');
})->before('auth_room');

Route::get('roomschedule/computerclassroom', function()
{
  return View::make('layouts.roomschedule')->nest('contentTabHolder','roomschedule.computerclassroomTab');
})->before('auth_room');

Route::get('roomschedule/breakoutroom', function()
{
  return View::make('layouts.roomschedule')->nest('contentTabHolder','roomschedule.breakoutroomTab');
})->before('auth_room');

Route::get('roomschedule/specialroom', function()
{
  return View::make('layouts.roomschedule')->nest('contentTabHolder','roomschedule.specialroomTab');
})->before('auth_room');

// Routes for the API
Route::controller('classroom','ClassroomController');
Route::controller('computerclassroom','ComputerClassroomController');
Route::controller('specialroom','SpecialRoomController');
Route::controller('breakoutroom','BreakoutRoomController');

Route::get('classroomlist', 'RoomListController@getClassroomList');
Route::get('computerclassroomlist', 'RoomListController@getComputerClassroomList');
Route::get('breakoutroomlist', 'RoomListController@getBreakoutRoomList');
Route::get('specialroomlist', 'RoomListController@getSpecialRoomList');

Route::get('roomschedule/api/kiosk', 'KioskApiController@getRoomSchedule');

// ----------------------------------------------------------------------------
// Routes for Inventory
// ----------------------------------------------------------------------------
// Routes for the tabs and views
Route::get('inventory/currentinventory', function() {
  return View::make('layouts.inventory')->nest('contentTabHolder','inventory.currentInventoryTab');
})->before('auth_inv');

Route::get('inventory/vieworders', function() {
  return View::make('layouts.inventory')->nest('contentTabHolder','inventory.viewOrdersTab');
})->before('auth_inv');

Route::get('inventory/placeorder', function() {
  return View::make('layouts.inventory')->nest('contentTabHolder','inventory.placeOrderTab');
})->before('auth_inv');

Route::get('inventory/viewlog', function() {
  return View::make('layouts.inventory')->nest('contentTabHolder','inventory.viewLogTab');
})->before('auth_inv');


// Routes for the API
Route::resource('inventory/api/items','InventoryApiController');
Route::resource('inventory/api/orders','OrderApiController');
Route::resource('inventory/api/log','LogApiController');
Route::get('inventory/api/vendors', 'VendorApiController@getVendors');

// ----------------------------------------------------------------------------
// Routes for AVLog
// ----------------------------------------------------------------------------
// Routes for the tabs and views
Route::get('avlog/classroom', function() {
  return View::make('layouts.avlog')->nest('contentTabHolder','avlog.classroomTab');
})->before('auth_avlog');

Route::get('avlog/computerclassroom', function() {
  return View::make('layouts.avlog')->nest('contentTabHolder','avlog.computerclassroomTab');
})->before('auth_avlog');

Route::get('avlog/breakoutroom', function() {
  return View::make('layouts.avlog')->nest('contentTabHolder','avlog.breakoutroomTab');
})->before('auth_avlog');

Route::get('avlog/specialroom', function() {
  return View::make('layouts.avlog')->nest('contentTabHolder','avlog.specialroomTab');
})->before('auth_avlog');

// Routes for the API
Route::resource('avlog/api/avlog','AVLogApiController');
Route::resource('avlog/api/ceasrooms','CeasRoomListApiController');

// ----------------------------------------------------------------------------
// Routes for Employee
// ----------------------------------------------------------------------------
Route::get('employee/myhours', function() {
  return View::make('layouts.employee')->nest('contentTabHolder','employee.employeeTab');
})->before('auth_emp');

Route::get('employee/adminschedule', function() {
  return View::make('layouts.employee')->nest('contentTabHolder','employee.employeeTab');
})->before('auth_emp');

Route::get('employee/attendantschedule', function() {
  return View::make('layouts.employee')->nest('contentTabHolder','employee.employeeTab');
})->before('auth_emp');

Route::get('employee/programmerschedule', function() {
  return View::make('layouts.employee')->nest('contentTabHolder','employee.employeeTab');
})->before('auth_emp');

Route::get('employee/timesheet', function() {
  return View::make('layouts.employee')->nest('contentTabHolder','employee.employeeTab');
})->before('auth_emp')->before('auth_view_timesheet');

// Routes for the API
// Routes for the viewable tabs and user permissions
Route::resource('employee/api/viewabletabs','ViewableTabsApiController');
Route::resource('employee/api/userpermissions','UserPermissionsApiController');

// Routes for the admin, attendant, and programmer schedule
Route::controller('employee/api/adminschedule', 'AdminScheduleApiController');
Route::controller('employee/api/attendantschedule', 'AttendantScheduleApiController');
Route::controller('employee/api/programmerschedule', 'ProgrammerScheduleApiController');

// Routes for the admin, attendant, and programmer employee info
Route::get('employee/api/adminscheduleinfo', 'ScheduleInfoApiController@getAdminScheduleInfo');
Route::get('employee/api/attendantscheduleinfo', 'ScheduleInfoApiController@getAttendantScheduleInfo');
Route::get('employee/api/programmerscheduleinfo', 'ScheduleInfoApiController@getProgrammerScheduleInfo');

// Route to get the end of the next semester. This is used to set the unitl date for new employee shifts
Route::get('employee/api/endofnextsemester', 'ScheduleInfoApiController@getEndOfNextSemester');

// Routes for getting all employee shifts, clocking in and out, and getting server time.

//Route::get('employee/api/usershifts', 'ShiftApiController@getAllShifts');

Route::get('employee/api/payperiod', 'ShiftApiController@getPayPeriod');
Route::get('employee/api/usershifts', 'ShiftApiController@getShifts');
Route::get('employee/api/servertime', 'ShiftApiController@getServerTime');
Route::put('employee/api/usershift', 'ShiftApiController@clockOut');
Route::post('employee/api/usershift', 'ShiftApiController@clockIn');

// ----------------------------------------------------------------------------
// Routes for User Admin
// ----------------------------------------------------------------------------
Route::get('useradmin/userlist', function() {
  return View::make('layouts.useradmin')->nest('contentTabHolder','useradmin.userlistTab');
})->before('auth_useradm');

// Routes for the API
Route::resource('useradmin/api/users','UsersApiController');
Route::resource('useradmin/api/userstype','UsersTypeApiController');

// ----------------------------------------------------------------------------
// Routes for login/logout
// ----------------------------------------------------------------------------

Route::get('login', array('as' => 'login', function() {
	return View::make('pages.login');
 }))->before('guest');
Route::post('login', function(){
	$user = array(
		'username' => Input::get('username'),
		'password' => Input::get('password')
	);

	if (Auth::attempt($user)) {
        return Redirect::route('home')
            ->with('flash_notice', 'You are successfully logged in.');
    }
    
    // authentication failure! lets go back to the login page
    return Redirect::route('login')
        ->with('flash_error', 'Your username/password combination was incorrect.')
        ->withInput();
});
Route::get('logout', array('as' => 'logout', function() {
	Auth::logout();

	return Redirect::route('home')
		->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');
