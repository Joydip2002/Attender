<?php

use App\Http\Controllers\AttenderController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return redirect('/');
});
// Start Admin Route
Route::get('/', [AttenderController::class, 'login']);
Route::post('/login', [AttenderController::class, 'loginEnter'])->name('login');
Route::get('/signup', [AttenderController::class, 'signup']);
Route::post('/signup', [AttenderController::class, 'signupSave'])->name('signupsave');



Route::post('/studentRegister', [AttenderController::class, 'addStudentSave'])->name('student-register');

//End Admin Route

// AjaxRoute RoleController
Route::get("/role-fetch", [RoleController::class, 'rolefetch'])->name('role-fetch');

// Start teacher Route
Route::group(['middleware' => ['web', 'isTeacher']], function () {
    Route::get('/attendenceBook', [AttenderController::class, 'attendenceBook']);
    Route::get('/teacherLogout',[AttenderController::class,'teacherLogout']);
});
// End teacher Route
// Start Student Route
Route::group(['middleware' => ['web', 'isStudent']], function () {
    Route::get('/studentDashboard', [AttenderController::class, 'studentDashboard']);
    Route::get('/studentDashboardPage', [AttenderController::class, 'studentDashboardPage']);
    Route::get('/studentReport', [AttenderController::class, 'studentReport']);
    Route::get('/studentLogout', [AttenderController::class, 'studentLogout']);
});
// End Student Route

// Start Admin Route
Route::group(['middleware' => ['web', 'isAdmin']], function () {
    Route::get("/dashboard", [AttenderController::class, 'dashboard']);
    Route::get('/adminDashboard', [AttenderController::class, 'adminDashboard']);
    Route::get('/addClass', [AttenderController::class, 'addClass']);
    Route::post('/addClassroom', [AttenderController::class, 'addClassroom'])->name('add-classroom');
    Route::get('/adminLogout', [AttenderController::class, 'adminLogout']);
    Route::get("/addTeacher", [AttenderController::class, 'addTeacher']);
    Route::get("/addStudent", [AttenderController::class, 'addStudent']);
    Route::get('/addAdmin', [AttenderController::class, 'addAdmin']);
});
// End Admin Route