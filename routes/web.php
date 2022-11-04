<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InviteController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\ProjectController::class, 'index'])->name('home');
Route::post('/home',[App\Http\Controllers\ProjectController::class, 'insert'])->name('home');
Route::post('/invite', [App\Http\Controllers\InviteController::class, 'save'])->name('invite');
Route::get('/invite/{id}',[App\Http\Controllers\InviteController::class, 'direct'])->name('invite');
Route::get('/projectpage',[App\Http\Controllers\ProjectPageController::class, 'index'])->name('projectpage');
Route::get('/projectpage/{id}', [App\Http\Controllers\ProjectPageController::class, 'direct'])->name('project');
// Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');
Route::get('/backlog/{id}', [App\Http\Controllers\BacklogController::class, 'direct'])->name('backlog');
Route::post('/workitems', [App\Http\Controllers\WorkitemController::class, 'insert'])->name('workitems');
Route::get('/workitems/{id}', [App\Http\Controllers\WorkitemController::class, 'direct'])->name('workitems');
//Route::get('/board', [App\Http\Controllers\BoardController::class, 'index'])->name('board');
Route::post('/board', [App\Http\Controllers\BoardController::class, 'update'])->name('board');
Route::get('/board/{id}', [App\Http\Controllers\BoardController::class, 'direct'])->name('board');
Route::post('/deletesprint', [App\Http\Controllers\SprintPlanningController::class, 'delete'])->name('sprintplanning');
Route::post('/sprintplanning', [App\Http\Controllers\SprintPlanningController::class, 'save'])->name('sprintplanning');
Route::get('/sprintplanning/{id}', [App\Http\Controllers\SprintPlanningController::class, 'direct'])->name('sprintplanning');
Route::post('/sprintreview', [App\Http\Controllers\SprintReviewController::class, 'save'])->name('sprintreview');
Route::get('/sprintreview/{id}', [App\Http\Controllers\SprintReviewController::class, 'direct'])->name('sprintreview');
Route::post('/delete', [App\Http\Controllers\RetrospectiveController::class, 'delete'])->name('retrospective');
Route::post('/retrospective', [App\Http\Controllers\RetrospectiveController::class, 'save'])->name('retrospective');
Route::get('/retrospective/{id}', [App\Http\Controllers\RetrospectiveController::class, 'direct'])->name('retrospective');
Route::post('/sprintboard', [App\Http\Controllers\SprintBoardController::class, 'update'])->name('sprintboard');
Route::get('/sprintboard/{id}', [App\Http\Controllers\SprintBoardController::class, 'direct'])->name('sprintboard');
