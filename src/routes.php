<?php

namespace Src;

use System\Routing\Router as router;

/* All Route Goes Here */
router::get('', 'welcomeController@index');

/* Extending Routes */
router::extend('extended_routes');
