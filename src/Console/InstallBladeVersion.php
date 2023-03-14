<?php
namespace Tommypria\Astronaut\Console;

use Exception;
use Illuminate\Filesystem\Filesystem;

trait InstallBladeVersion
{
    protected function installBladeVersion()
    {
        // Controllers
        (new Filesystem)->ensureDirectoryExists( app_path("Http/Controllers") );
        (new Filesystem)->copyDirectory( __DIR__ . "/../../stubs/Controllers", app_path("Http/Controllers") );

        // Requests
        (new Filesystem)->ensureDirectoryExists( app_path("Http/Requests") );
        (new Filesystem)->copyDirectory( __DIR__ . "/../../stubs/Requests", app_path("Http/Requests") );

        // Services
        (new Filesystem)->ensureDirectoryExists( app_path("Services") );
        (new Filesystem)->copyDirectory( __DIR__ . "/../../stubs/Services", app_path("Services") );

        // Routes
        try {
            $web = fopen(base_path("routes/web.php"), "a") or die ("Unable to open file");
            $include = "\nrequire __DIR__ . '/astronaut.php';\n";
            fwrite($web, $include);
            fclose($web);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        copy( __DIR__ . "/../../stubs/routes/astronaut.php", base_path('routes/astronaut.php') );
    }
}