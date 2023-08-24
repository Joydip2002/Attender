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
    Route::post('/studentView',[AttenderController::class,'viewStudent']);
    Route::get('/studentAttendenceRecord',[AttenderController::class,'giveAttendence']);
    // Route::get('/updateClass',[AttenderController::class,'updateClassStatus']);
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
    Route::get("/viewClass", [AttenderController::class, 'viewClass']);
    Route::get('/addAdmin', [AttenderController::class, 'addAdmin']);
    Route::post('/grantedTeacherPage',[AttenderController::class,'grantedTeacher']);
    Route::post('/deniedTeacherPage',[AttenderController::class,'deniedTeacher']);
    Route::post('/studentGrantedPage',[AttenderController::class,'studentGranted']);
    Route::post('/studentDeniedPage',[AttenderController::class,'studentDenied']);

    Route::post('/classActivePage',[AttenderController::class,'classActive']);
    Route::post('/classInactivePage',[AttenderController::class,'classInactive']);

    Route::get('/chart',[AttenderController::class,'chartRegistration']);
    Route::post('/showDataUpdateModal',[AttenderController::class,'edit']);
    Route::post('/updateDetails',[AttenderController::class,'updateDetails']);
    Route::post('/studentDataUpdate',[AttenderController::class,'studentedit']);
    Route::post('/updateDetailsStudent',[AttenderController::class,'updateDetailsStudent']);
    Route::post('/teacherDataUpdate',[AttenderController::class,'teacheredit']);
    Route::post('/teacherDetailsStudent',[AttenderController::class,'updateDetailsTeacher']);
    // Route::get('/registrationStudentPerDay',[AttenderController::class,'registrationStudent']);
});
// End Admin Route