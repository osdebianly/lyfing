<?php

Route::get('flow', 'FlowController@index')->name('admin.flow');

Route::group(['prefix' => 'user/{user}', 'where' => ['user' => '[0-9]+']], function ($user) {
    Route::get('flow/{flow}', 'FlowController@update')
        ->where(['user' => '[0-9]+', 'flow' => '[0-9]+'])
        ->name('admin.flow.update');

});

   