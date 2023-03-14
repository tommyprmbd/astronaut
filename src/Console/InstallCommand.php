<?php
namespace Tommypria\Astronaut\Console;

use Illuminate\Console\Command;
use Tommypria\Astronaut\Console\InstallBladeVersion;

class InstallCommand extends Command
{
    use InstallBladeVersion;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astronaut:install';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install feature management user.';
 
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->installBladeVersion();

        return 1;
    }
}