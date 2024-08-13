<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

if (strpos($_SERVER['HTTP_HOST'], 'agr.loc')){
    define("SITE", 'agr.loc');
    define("PATH", 'prostitutki_nl');
    define("SITE_ID", 1);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutki.nl')){
    define("SITE", 'prostitutki.nl');
    define("PATH", 'prostitutki_nl');
    define("SITE_ID", 1);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'intim-now.com')){
    define("SITE", 'intim-now.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutki-nl.com')){
    define("SITE", 'prostitutki-nl.com');
    define("PATH", 'prostitutki_nl');
    define("SITE_ID", 1);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'proctytutki.com')){
    define("SITE", 'proctytutki.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutkitasty.com')){
    define("SITE", 'prostitutkitasty.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutkiportal.com')){
    define("SITE", 'prostitutkiportal.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}

elseif (strpos($_SERVER['HTTP_HOST'], 'dosug-nights.com')){
    define("SITE", 'dosug-nights.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutki-service.com')){
    define("SITE", 'prostitutki-service.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutki-tasty.com')){
    define("SITE", 'prostitutki-tasty.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'intim-hub.com')){
    define("SITE", 'intim-hub.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutki-box.com')){
    define("SITE", 'prostitutki-box.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'prostitutkyhub.com')){
    define("SITE", 'prostitutkyhub.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'proctitytki.com')){
    define("SITE", 'proctitytki.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'proctitytkihub.com')){
    define("SITE", 'proctitytkihub.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'proctitytkizone.com')){
    define("SITE", 'proctitytkizone.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'proctitytkisensual.com')){
    define("SITE", 'proctitytkisensual.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'proctitytkiportal.com')){
    define("SITE", 'proctitytkiportal.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'intim-box.loc')){
    define("SITE", 'intim-box.loc');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'intim-box2.loc')){
    define("SITE", 'intim-box2.loc');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
elseif (strpos($_SERVER['HTTP_HOST'], 'intim-box.com')){
    define("SITE", 'intim-box.com');
    define("PATH", 'intim-box');
    define("SITE_ID", 2);
}
else{
    define("SITE", '');
    define("PATH", '');
    define("SITE_ID", 0);
}


$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
