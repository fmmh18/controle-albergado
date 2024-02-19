<?php

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


Route::get('/', function () {
    return redirect(route('login'));
});

route::get('/login', function () {
    return redirect(route('login'));
});


Route::group(['namespace' => 'dashboard', 'prefix' => 'dashboard'], function () {

    Route::get('/login', [\App\Http\Controllers\dashboard\loginController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\dashboard\loginController::class, 'login'])->name('auth');
    Route::get('/logout', [\App\Http\Controllers\dashboard\loginController::class, 'logout'])->name('logout');
    Route::get('/ativar', [\App\Http\Controllers\dashboard\loginController::class, 'active'])->name('active');

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/home', [\App\Http\Controllers\dashboard\homeController::class, 'index'])->name('dashboard.home');

        //ME
        Route::get('/meus-dados', [\App\Http\Controllers\dashboard\userController::class, 'showMe'])->name('dashboard.show-me');
        Route::put('/meus-dados', [\App\Http\Controllers\dashboard\userController::class, 'updateMe'])->name('dashboard.update-me');

        //USUARIO
        Route::get('/usuario/listar', array('as' => 'dashboard.user.index', 'uses' => '\App\Http\Controllers\dashboard\userController@index', 'nickname' => "Listar Usuários", "groupname" => "Usuário"));
        Route::get('/usuario/adicionar', array('as' => 'dashboard.user.create', 'uses' => '\App\Http\Controllers\dashboard\userController@create', 'nickname' => "Criar Usuário", "groupname" => "Usuário"));
        Route::post('/usuario/adicionar', array('as' => 'dashboard.user.store', 'uses' => '\App\Http\Controllers\dashboard\userController@store', 'nickname' => "Salvar Usuário", "groupname" => "Usuário"));
        Route::get('/usuario/editar/{id}', array('as' => 'dashboard.user.show', 'uses' => '\App\Http\Controllers\dashboard\userController@show', 'nickname' => "Visualizar Usuário", "groupname" => "Usuário"));
        Route::put('/usuario/editar/{id}', array('as' => 'dashboard.user.update', 'uses' => '\App\Http\Controllers\dashboard\userController@update', 'nickname' => "Editar Usuário", "groupname" => "Usuário"));
        Route::get('/usuario/deletar/{id}', array('as' => 'dashboard.user.delete', 'uses' => '\App\Http\Controllers\dashboard\userController@destroy', 'nickname' => "Deletar Usuário", "groupname" => "Usuário"));


        //PACIENTE
        Route::get('/paciente/listar', array('as' => 'dashboard.patient.index', 'uses' => '\App\Http\Controllers\dashboard\patientController@index', 'nickname' => "Listar Paciente", "groupname" => "Paciente"));
        Route::get('/paciente/adicionar', array('as' => 'dashboard.patient.create', 'uses' => '\App\Http\Controllers\dashboard\patientController@create', 'nickname' => "Criar Paciente", "groupname" => "Paciente"));
        Route::post('/paciente/adicionar', array('as' => 'dashboard.patient.store', 'uses' => '\App\Http\Controllers\dashboard\patientController@store', 'nickname' => "Salvar Paciente", "groupname" => "Paciente"));
        Route::get('/paciente/editar/{id}', array('as' => 'dashboard.patient.show', 'uses' => '\App\Http\Controllers\dashboard\patientController@show', 'nickname' => "Visualizar Paciente", "groupname" => "Paciente"));
        Route::put('/paciente/editar/{id}', array('as' => 'dashboard.patient.update', 'uses' => '\App\Http\Controllers\dashboard\patientController@update', 'nickname' => "Editar Paciente", "groupname" => "Paciente"));
        Route::get('/paciente/deletar/{id}', array('as' => 'dashboard.patient.delete', 'uses' => '\App\Http\Controllers\dashboard\patientController@destroy', 'nickname' => "Deletar Paciente", "groupname" => "Paciente"));


        Route::post('/entrada-saida/adicionar', array('as' => 'dashboard.card.store', 'uses' => '\App\Http\Controllers\dashboard\cardController@store', 'nickname' => "Salvar Entrada/Saida", "groupname" => "Entrada"));
        Route::put('/entrada-saida/editar/{id}', array('as' => 'dashboard.card.update', 'uses' => '\App\Http\Controllers\dashboard\cardController@update', 'nickname' => "Editar Entrada/Saida", "groupname" => "Entrada"));

        Route::group(['namespace' => 'api', 'prefix' => 'api'], function () {
            Route::get('/v2/entrada-saida/visualizar/{id}', array('as' => 'dashboard.card.view', 'uses' => '\App\Http\Controllers\dashboard\cardController@view', 'nickname' => "Visualizar API Entrada/Saida", "groupname" => "Entrada"));
        });
    });
});
