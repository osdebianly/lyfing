<?php

/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('macros', 'FrontendController@macros')->name('frontend.macros');
Route::get('client', 'FrontendController@client')->name('frontend.client');
Route::get('code', 'FrontendController@code')->name('frontend.code');
Route::get('finalspeed', 'FrontendController@finalSpeed')->name('frontend.finalspeed');


/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');

    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('frontend.user.index');
        Route::get('/index', 'UserController@index');
        Route::post('/checkin', 'UserController@checkin');
        Route::get('/profile', 'UserController@profile');
        Route::get('/edit', 'UserController@edit');
        Route::post('/password', 'UserController@updatePassword');
        Route::post('/updateSS', 'UserController@updateSS');
        Route::get('/destroy', 'UserController@destroy');
        Route::get('/invite', 'UserController@invite');
        Route::post('/makeInviteCode', 'UserController@makeInviteCode');
        Route::get('/flow', 'UserController@flow');
        Route::get('/download', 'UserController@download');
        Route::post('/download', 'UserController@downloadCommand');
        Route::get('/download/delete/{file}', function($file,\Illuminate\Filesystem\Filesystem $filesystem){
            $filePath = public_path(access()->user()->email.'/'.$file) ;
            if($filesystem->exists($filePath)){
                $filesystem->delete($filePath)  ;
            }
            return back() ;
        });

    });

});