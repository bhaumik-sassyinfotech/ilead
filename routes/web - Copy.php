<?php

Route::get('/', function () {
    return redirect('/index');
});

$this->get('index', 'HomeController@dashboard');
$this->get('safety-support', 'HomeController@pagecontent');
$this->get('privacy-policy', 'HomeController@privacypolicy');
$this->get('terms-conditions', 'HomeController@termsconditions');
$this->get('signin', 'HomeController@login');
// Route::get('/', 'HomeController@index');
$this->post('register', 'HomeController@register');
$this->post('signin', 'HomeController@signin');
$this->post('logout', 'HomeController@logout');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '/admin'], function () {

    // Authentication Routes...
    $this->get('cmsview', 'CmsController@view')->name('cms.view');
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');

    $this->post('login', 'Auth\LoginController@login')->name('auth.login');
    $this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
    $this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

    Route::group(['middleware' => 'auth'], function () {

        // For Change Password
        Route::get('/change-password', function() {
            return view('admin.change_password.change');
        });
        Route::post('/change-password', 'Auth\UpdatePasswordController@update');


        Route::get('/home', 'HomeController@index');
        Route::post('/userSearch', 'UsersController@userSearch');
        Route::get('userSearch', 'UsersController@userSearch');

        Route::resource('cms', 'CmsController');
        Route::post('/cmsSearch', 'CmsController@cmsSearch');
        Route::get('cmsSearch', 'CmsController@cmsSearch');

        // For Roles 
        Route::resource('roles', 'RolesController');
        Route::post('/searchRoles', 'RolesController@searchRoles');
        Route::get('searchRoles', 'RolesController@searchRoles');
        Route::post('/deletesss', 'RolesController@deletesss');
        Route::delete('roles_mass_destroy', [
            'uses' => 'RolesController@massDestroy',
            'as' => 'roles.mass_destroy'
        ]);

        // For Coins
        Route::resource('coins', 'CoinsController');
        Route::post('/searchCoins', 'CoinsController@searchCoins');
        Route::get('searchCoins', 'CoinsController@searchCoins');
        Route::delete('coins_mass_destroy', [
            'uses' => 'CoinsController@massDestroy',
            'as' => 'coins.mass_destroy'
        ]);

        // For Plans
        Route::resource('plans', 'PlansController');
        Route::post('/searchPlans', 'PlansController@searchPlans');
        Route::get('searchPlans', 'PlansController@searchPlans');
        Route::delete('plans_mass_destroy', [
            'uses' => 'PlansController@massDestroy',
            'as' => 'plans.mass_destroy'
        ]);

        

        Route::resource('emailtemplate', 'EmailtemplateController');
        Route::post('/searchEmailtemplate', 'EmailtemplateController@searchEmailtemplate');
        Route::get('searchEmailtemplate', 'EmailtemplateController@searchEmailtemplate');

        Route::resource('users', 'UsersController');
        Route::get('myprofile/{id}', ['uses' => 'UsersController@myprofile', 'as' => 'users.myprofile']);
        Route::put('myprofile_update/{id}', 'UsersController@myprofile_update')->name('users.myprofile_update');
        Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
        Route::resource('user_actions', 'UserActionsController');
        Route::resource('settings', 'SettingsController');
        Route::resource('currencies', 'CurrenciesController');
        Route::post('currencies_mass_destroy', ['uses' => 'CurrenciesController@massDestroy', 'as' => 'currencies.mass_destroy']);
        Route::resource('transaction_types', 'TransactionTypesController');
        Route::post('transaction_types_mass_destroy', ['uses' => 'TransactionTypesController@massDestroy', 'as' => 'transaction_types.mass_destroy']);
        Route::resource('income_sources', 'IncomeSourcesController');
        Route::post('income_sources_mass_destroy', ['uses' => 'IncomeSourcesController@massDestroy', 'as' => 'income_sources.mass_destroy']);
        Route::resource('client_statuses', 'ClientStatusesController');
        Route::post('client_statuses_mass_destroy', ['uses' => 'ClientStatusesController@massDestroy', 'as' => 'client_statuses.mass_destroy']);
        Route::resource('project_statuses', 'ProjectStatusesController');
        Route::post('project_statuses_mass_destroy', ['uses' => 'ProjectStatusesController@massDestroy', 'as' => 'project_statuses.mass_destroy']);
        Route::resource('clients', 'ClientsController');
        Route::post('clients_mass_destroy', ['uses' => 'ClientsController@massDestroy', 'as' => 'clients.mass_destroy']);
        Route::resource('projects', 'ProjectsController');
        Route::post('projects_mass_destroy', ['uses' => 'ProjectsController@massDestroy', 'as' => 'projects.mass_destroy']);
        Route::resource('notes', 'NotesController');
        Route::post('notes_mass_destroy', ['uses' => 'NotesController@massDestroy', 'as' => 'notes.mass_destroy']);
        Route::resource('documents', 'DocumentsController');
        Route::post('documents_mass_destroy', ['uses' => 'DocumentsController@massDestroy', 'as' => 'documents.mass_destroy']);
        Route::resource('transactions', 'TransactionsController');
        Route::post('transactions_mass_destroy', ['uses' => 'TransactionsController@massDestroy', 'as' => 'transactions.mass_destroy']);
        Route::resource('reports', 'ReportsController');

        //For Website Meta
        Route::resource('meta', 'MetaController');
        Route::post('/metaSearch', 'MetaController@metaSearch');
        Route::get('metaSearch', 'MetaController@metaSearch');
    });
});