<?php

namespace Config;

use RestClient\Router as router;

/* All Route Goes Here */
router::get('', 'welcomeController@index');

router::get('test','welcomeController@test');