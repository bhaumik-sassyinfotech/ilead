<?php
    /*
    Route::get('/', function () {
        return redirect('/index');
    });
    */
//    Route::get('dashboard', function () {
//        return redirect('home/dashboard');
//    });
//    Route::get('/' , 'HomeController@index');
    Route::get('/',function() {
        return redirect('admin/login');
    });
    Route::get('/index' , function() {
        return redirect('admin/login');
    });
    
    Route::group(['middleware' => 'guest'] , function ()
    {
        $this->get('signin' , 'HomeController@login');
        $this->post('register' , 'HomeController@register');
        $this->post('signin' , 'HomeController@signin');
    });
    
    Route::group(['prefix' => '/account'] , function ()
    {
        Route::group(['middleware' => 'auth'] , function ()
        {
            // Authentication Routes...
            $this->get('/' , 'AccountController@showProfileForm')->name('auth.profile');
            $this->get('profile' , 'AccountController@showProfileForm')->name('auth.profile');
            $this->post('profile' , 'AccountController@profile')->name('auth.profile');
            $this->post('logout' , 'AccountController@logout')->name('auth.logout');
            
        });
    });
    
    Route::group(['prefix' => '/admin'] , function ()
    {
        
        Route::group(['middleware' => 'admin_guest'] , function ()
        {
            // Authentication Routes...
            $this->get('login' , 'Admin\Auth\LoginController@showLoginForm')->name('auth.login');
            
            $this->post('login' , 'Admin\Auth\LoginController@login')->name('auth.login');
            
            
            // Registration Routes...
            $this->get('register' , 'Admin\Auth\RegisterController@showRegistrationForm')->name('auth.register');
            $this->post('register' , 'Admin\Auth\RegisterController@register')->name('auth.register');
            
            // Password Reset Routes...
            $this->get('password/reset' , 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
            $this->post('password/email' , 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
            $this->get('password/reset/{token}' , 'Admin\Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
            $this->post('password/reset' , 'Admin\Auth\ResetPasswordController@reset')->name('auth.password.reset');
        });
        
        Route::group(['middleware' => 'admin'] , function ()
        {
            
            // For Change Password
            Route::get('/change-password' , function ()
            {
                return view('admin.change_password.change');
            });
            Route::post('/change-password' , 'Admin\Auth\UpdatePasswordController@update');
            $this->post('logout' , 'Admin\Auth\LoginController@logout')->name('auth.logout');
            
            Route::get('/dashboard' , 'Admin\DashboardController@index');
            //Route::get('', 'Admin\DashboardController@index');
            Route::get('/' , 'Admin\DashboardController@index');
            Route::post('/userSearch' , 'Admin\UsersController@userSearch');
            Route::get('userSearch' , 'Admin\UsersController@userSearch');
            
            //cms
            Route::resource('cms' , 'Admin\CmsController');
            Route::post('/cmsSearch' , 'Admin\CmsController@cmsSearch');
            Route::get('cmsSearch' , 'Admin\CmsController@cmsSearch');
            
            //block
            Route::resource('block' , 'Admin\BlockController');
            Route::post('/blockSearch' , 'Admin\BlockController@blockSearch');
            Route::get('blockSearch' , 'Admin\BlockController@blockSearch');
            
            
            //faqcategorys
            Route::resource('faqcategorys' , 'Admin\FaqcategoryController');
            Route::post('/faqcategorysSearch' , 'Admin\FaqcategoryController@faqcategorysSearch');
            Route::get('faqcategorysSearch' , 'Admin\FaqcategoryController@faqcategorysSearch');
            
            //faqmodule
            Route::resource('faqmodule' , 'Admin\FaqmoduleController');
            Route::post('/faqmoduleSearch' , 'Admin\FaqmoduleController@faqmoduleSearch');
            Route::get('faqmoduleSearch' , 'Admin\FaqmoduleController@faqmoduleSearch');
            
            
            //notification
            
            Route::resource('notification' , 'Admin\NotificationController');
            Route::post('/notificationSearch' , 'Admin\NotificationController@notificationSearch');
            Route::get('notificationSearch' , 'Admin\NotificationController@notificationSearch');
            //messages
            
            Route::resource('messages' , 'Admin\MessagesController');
            Route::post('/messagesSearch' , 'Admin\MessagesController@messagesSearch');
            Route::get('messagesSearch' , 'Admin\MessagesController@messagesSearch');
            
            //storeLanguage
            Route::resource('storeLanguage' , 'Admin\StoreLanguageController');
            Route::post('/storeLanguageSearch' , 'Admin\StoreLanguageController@storeLanguageSearch');
            Route::get('storeLanguageSearch' , 'Admin\StoreLanguageController@storeLanguageSearch');
            
            //Country
            Route::resource('country' , 'Admin\CountryController');
            Route::post('/countrySearch' , 'Admin\CountryController@countrySearch');
            Route::get('countrySearch' , 'Admin\CountryController@countrySearch');
            
            //currency
            Route::resource('currency' , 'Admin\CurrencyController');
            //follow up
            Route::resource('follow_up' , 'Admin\FollowUpController');
            //international Source
            Route::resource('source','Admin\SourceController');
            //Route::get('currency','Admin\CurrencyController@index')->name('currency.index');
            //Route::post('/currencySearch', 'Admin\CurrencyController@currencySearch');
            //Route::get('currencySearch', 'Admin\CurrencyController@currencySearch');
            
            //settings
            Route::resource('settings' , 'Admin\SettingsController');
            Route::get('/readSettingData' , 'Admin\SettingsController@readSettingXML')->name('readSettingData');
            
            // For Roles
            Route::resource('roles' , 'Admin\RolesController');
            Route::post('/searchRoles' , 'Admin\RolesController@searchRoles');
            Route::get('searchRoles' , 'Admin\RolesController@searchRoles');
            Route::post('/deletesss' , 'Admin\RolesController@deletesss');
            Route::delete('roles_mass_destroy' , [
                'uses' => 'Admin\RolesController@massDestroy' ,
                'as'   => 'roles.mass_destroy'
            ]);
            
            Route::resource('emailtemplate' , 'Admin\EmailtemplateController');
            Route::post('/searchEmailtemplate' , 'Admin\EmailtemplateController@searchEmailtemplate');
            Route::get('searchEmailtemplate' , 'Admin\EmailtemplateController@searchEmailtemplate');
            
            Route::resource('users' , 'Admin\UsersController');
            Route::get('myprofile/{id}' , ['uses' => 'Admin\UsersController@myprofile' , 'as' => 'users.myprofile']);
            Route::put('myprofile_update/{id}' , 'Admin\UsersController@myprofile_update')->name('users.myprofile_update');
            Route::post('users_mass_destroy' , ['uses' => 'Admin\UsersController@massDestroy' , 'as' => 'users.mass_destroy']);
            Route::resource('user_actions' , 'Admin\UserActionsController');
            Route::resource('settings' , 'Admin\SettingsController');
            Route::resource('currencies' , 'Admin\CurrenciesController');
            Route::post('currencies_mass_destroy' , ['uses' => 'Admin\CurrenciesController@massDestroy' , 'as' => 'currencies.mass_destroy']);
            Route::resource('transaction_types' , 'Admin\TransactionTypesController');
            Route::post('transaction_types_mass_destroy' , ['uses' => 'Admin\TransactionTypesController@massDestroy' , 'as' => 'Admin\transaction_types.mass_destroy']);
            Route::resource('income_sources' , 'IncomeSourcesController');
            Route::post('income_sources_mass_destroy' , ['uses' => 'Admin\IncomeSourcesController@massDestroy' , 'as' => 'income_sources.mass_destroy']);
            Route::resource('client_statuses' , 'ClientStatusesController');
            Route::post('client_statuses_mass_destroy' , ['uses' => 'Admin\ClientStatusesController@massDestroy' , 'as' => 'client_statuses.mass_destroy']);
            Route::resource('project_statuses' , 'ProjectStatusesController');
            Route::post('project_statuses_mass_destroy' , ['uses' => 'Admin\ProjectStatusesController@massDestroy' , 'as' => 'project_statuses.mass_destroy']);
            Route::resource('clients' , 'ClientsController');
            Route::post('clients_mass_destroy' , ['uses' => 'Admin\ClientsController@massDestroy' , 'as' => 'clients.mass_destroy']);
            Route::resource('projects' , 'ProjectsController');
            Route::post('projects_mass_destroy' , ['uses' => 'Admin\ProjectsController@massDestroy' , 'as' => 'projects.mass_destroy']);
            Route::resource('notes' , 'NotesController');
            Route::post('notes_mass_destroy' , ['uses' => 'Admin\NotesController@massDestroy' , 'as' => 'notes.mass_destroy']);
            Route::resource('documents' , 'DocumentsController');
            Route::post('documents_mass_destroy' , ['uses' => 'Admin\DocumentsController@massDestroy' , 'as' => 'documents.mass_destroy']);
            Route::resource('transactions' , 'TransactionsController');
            Route::post('transactions_mass_destroy' , ['uses' => 'Admin\TransactionsController@massDestroy' , 'as' => 'transactions.mass_destroy']);
            Route::resource('reports' , 'Admin\ReportsController');
            
            //For Website Meta
            Route::resource('meta' , 'Admin\MetaController');
            Route::post('/metaSearch' , 'Admin\MetaController@metaSearch');
            Route::get('metaSearch' , 'Admin\MetaController@metaSearch');
            
            //International Lead
            Route::post('international/ajaxInsert' , 'Admin\InternationalLeadController@ajaxInsert')->name('international.ajaxInsert');
            Route::put('international/ajaxUpdate' , 'Admin\InternationalLeadController@ajaxUpdate')->name('international.ajaxUpdate');
            Route::delete('international/ajaxDelete' , 'Admin\InternationalLeadController@ajaxDelete')->name('international.ajaxDelete');
            Route::post('international/ajax' , 'Admin\InternationalLeadController@ajax')->name('international.ajax');
            Route::post('international/searchLead', 'Admin\InternationalLeadController@searchLead')->name('international.searchLead');
            Route::resource('international' , 'Admin\InternationalLeadController');
            
            
        });
    });
