<?php
namespace Tommypria\Astronaut;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AstronautServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap service
     */
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
            Console\DevelopmentConsole::class,
        ]);
    }

    public function provides()
    {
        return [Console\InstallCommand::class];
    }
}