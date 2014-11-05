<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//faccat routes
Route::model('disciplina', 'Disciplina');

Route::when('*', 'csrf', array('post'));
 
# Index Page
Route::get('/', 'HomeController@getIndex');
# No laravel, rotas são FIFO(First In, First Out), ou seja, as rotas existirão conforme a ordem de declaração
Route::get('professores/{slug}', 'ProfessorController@getShow');
Route::controller('professores', 'ProfessorController');
Route::post('disciplinas/inscricao_usuario', 'DisciplinasController@inscricao_usuario');
Route::get('disciplinas/{slug}', 'DisciplinasController@getShow');
Route::controller('disciplinas', 'DisciplinasController');

Route::post(
    'disciplinas/search', 
    array(
        'as' => 'disciplinas.search', 
        'uses' => 'DisciplinasController@postSearch'
    )
);

Route::get('/facebook', 'connectController@loginWithFacebook');	
Route::get('/twitter', 'connectController@loginWithTwitter');	
Route::get('/google', 'connectController@loginWithGoogle');   
Route::get('/linkedin', 'connectController@loginWithLinkedin');   

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function(){

    #Adminstração de Disciplinas
    Route::get('disciplinas/{post}/editar', 'AdminDisciplinasController@getEditar');
    Route::post('disciplinas/{post}/editar', 'AdminDisciplinasController@postEditar');
    Route::get('disciplinas/{post}/remover', 'AdminDisciplinasController@getRemover');
    Route::post('disciplinas/{post}/remover', 'AdminDisciplinasController@postRemover');
    Route::controller('disciplinas', 'AdminDisciplinasController');
});	

/** ------------------------------------------
 *  Api Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'api'), function() {

    //Route::controller('aulas', 'AulasController',
    Route::resource('aulas', 'AulasController', 
        array('only' => array('index', 'store', 'destroy')));
});

// Visitante
/*
Route::get('/',
        array(
            'as' => 'home', 
            'uses' => 'HomeController@getIndex'
            )
        );
*/

Route::get('entrar', 'HomeController@getEntrar');
Route::post('entrar', 'HomeController@postEntrar');
Route::get('registrar', 'HomeController@getRegistrar');
Route::post('registrar', 'HomeController@postRegistrar');
Route::get('sair', 'HomeController@getSair');

// Verifica se o usuário está logado
Route::group(array('before' => 'auth'), function()
{
    Route::controller('timeline', 'TimelineController');
    // Rota de disciplinas
    //Route::controller('disciplinas', 'DisciplinasController');
    
    // Rotas do administrador
    /*
    Route::group(array('before' => 'auth.admin'), function()
    {
        Route::controller('usuarios', 'UsuariosController');
    });
    */
});

/*
 
// Rota de disciplinas
Route::controller('disciplinas', 'DisciplinasController');
# Disciplinas - Slug
Route::get('{disciplinaSlug}', 'DisciplinasController@getView');
Route::post('{disciplinaSlug}', 'DisciplinasController@postView');

*/

/*
//Route::get('/', 'HomeController@showWelcome');
// Authentication
Route::get('login', 'AuthController@showLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@getLogout');

// Secure-Routes
Route::group(array('before' => 'auth'), function()
{
    Route::get('secret', 'HomeController@showSecret');
});
*/

    // ===============================================
    // 404 ===========================================
    // ===============================================

    App::missing(function($exception)
    {

        // shows an error page (app/views/error.blade.php)
        // returns a page not found error
        return Response::view('error.404', array(), 404);
    });

