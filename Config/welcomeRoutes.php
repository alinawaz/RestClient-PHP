<?php

namespace Config;

use RestClient\Router as router;

/* Extended Routes */

router::get('switch_language/{language_name}','welcomeController@switchLanguage');

// Todo Routes
router::get('todo','todoController@index');
router::get('todo/add','todoController@add');
router::get('todo/edit/{id}','todoController@edit');
router::get('todo/save','todoController@save');
router::get('todo/update','todoController@update');
router::get('todo/delete/{id}','todoController@remove');