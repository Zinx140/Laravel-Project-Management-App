<?php

use App\Http\Controllers\TugasWeek7;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::controller(TugasWeek7::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/doLogin', 'doLogin')->name('doLogin');
    Route::post('/doRegister', 'doRegister')->name('doRegister');
    Route::post('/logout', 'doLogout')->name('logout');
    Route::get('/manager/projects', 'viewManagerProjects')->name('manager-projects');
    Route::get('/manager/create-project', 'createManagerProjects')->name('create-manager-projects');
    Route::get('/employee/projects', 'viewEmployeeProjects')->name('employee-projects');
    Route::post('/manager/do-create', 'createProject')->name('doCreate');
    Route::post('/manager/project/delete/{id}', 'deleteProject')->name('delete-project');
    Route::post('/manager/project/update-status/{id}', 'updateProjectStatus')->name('update-project-status');
    Route::get('/manager/create-todo/{id}', 'viewManagerCreateTodo')->name('manager-create-todo');
    Route::post('/manager/do-create-todo/{id}', 'createToDo')->name('do-create-todo');
    Route::post('/employee/project/uodate-status-todo/{id}/{todo_id}', 'updateEmployeeToDo')->name('employee-update-todo');
    Route::get('/manager/project/{id}', 'viewManagerProjectDetail')->name('manager-project-detail');
    Route::get('/employee/project/{id}', 'viewEmployeeProjectDetail')->name('employee-project-detail');
});
