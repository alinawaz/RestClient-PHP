<?php

namespace Config;

use RestClient\Router as router;

/* Extended Routes */

router::get('switch_language/{language_name}','welcomeController@switchLanguage');