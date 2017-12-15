<?php

namespace Config;

use RestClient\Router as router;

/* All Route Goes Here */
router::get('', 'welcomeController@index');

/* Extending Routes */
router::extend('welcomeRoutes');
