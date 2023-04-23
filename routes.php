<?php
    require_once('./controllers/authorController.php');

    Route::get('/',function() { echo 'Hello, World!'; });
    Route::resource('author','authorController');
    Route::resource('author/search','authorController@search');

    Route::dispatch();
?>
