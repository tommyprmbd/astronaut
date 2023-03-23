<?php
namespace Tommypria\Astronaut\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class DevelopmentConsole extends Command
{
    private $filesystem;

    public function __construct()
    {
        parent::__construct();

        $this->filesystem = new Filesystem;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "astronaut:compose";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compose this package. Only used by the developer.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->copyController();

        $this->copyRequest();

        $this->copyService();

        $this->copyComponent();

        $this->copyRoute();

        $this->copyView();

        $this->copyAsset();

        return 1;
    }

    /**
     * Copy folders
     * 
     * @param array $folders
     * @param string $destination
     */
    private function copyFolders(array $folders, string $destination): void
    {
        foreach ($folders as $folder) {
            if (!$this->filesystem->ensureDirectoryExists($folder))
                $this->output("Folder $folder is not exist");
            else {
                $this->filesystem->copyDirectory($folder, $destination);
            }
        }
    }

    private function copyController()
    {
        $this->filesystem->copy( app_path("Http/Controllers/UserController.php"), __DIR__ . "/../../stubs/Controllers/UserController.php");
        $this->filesystem->copy( app_path("Http/Controllers/RoleController.php"), __DIR__ . "/../../stubs/Controllers/RoleController.php");
        $this->filesystem->copy( app_path("Http/Controllers/PermissionController.php"), __DIR__ . "/../../stubs/Controllers/PermissionController.php");
    }

    private function copyRequest()
    {
        $this->filesystem->copy( app_path("Http/Requests/UserRequest.php"), __DIR__ . "/../../stubs/Requests/UserRequest.php" );
        $this->filesystem->copy( app_path("Http/Requests/RoleRequest.php"), __DIR__ . "/../../stubs/Requests/RoleRequest.php" );
        $this->filesystem->copy( app_path("Http/Requests/PermissionRequest.php"), __DIR__ . "/../../stubs/Requests/PermissionRequest.php" );
    }

    private function copyService()
    {
        $this->filesystem->copy( app_path("Services/BaseService.php"), __DIR__ . "/../../stubs/Services/BaseService.php" );
        $this->filesystem->copy( app_path("Services/UserService.php"), __DIR__ . "/../../stubs/Services/UserService.php" );
        $this->filesystem->copy( app_path("Services/RoleService.php"), __DIR__ . "/../../stubs/Services/RoleService.php" );
        $this->filesystem->copy( app_path("Services/PermissionService.php"), __DIR__ . "/../../stubs/Services/PermissionService.php" );
    }

    private function copyComponent()
    {
        $this->filesystem->copy( app_path("View/Components/AppLayout.php"), __DIR__ . "/../../stubs/Components/AppLayout.php" );
    }

    private function copyRoute()
    {
        $this->filesystem->copy( base_path("routes/astronaut.php"), __DIR__ . "/../../stubs/routes/astronaut.php" );
    }

    private function copyView()
    {
        $this->filesystem->copyDirectory( base_path("resources/views/astronaut"), __DIR__ . "/../../stubs/views" );

        $this->filesystem->copy( base_path("resources/views/layouts/app.blade.php"), __DIR__ . "/../../stubs/views/layouts/app.blade.php");
        $this->filesystem->copy( base_path("resources/views/layouts/navigation.blade.php"), __DIR__ . "/../../stubs/views/layouts/navigation.blade.php");
        $this->filesystem->copy( base_path("resources/views/components/cancel-button.blade.php"), __DIR__ . "/../../stubs/views/components/cancel-button.blade.php");
        $this->filesystem->copy( base_path("resources/views/components/destroy-button.blade.php"), __DIR__ . "/../../stubs/views/components/destroy-button.blade.php");
        $this->filesystem->copy( base_path("resources/views/components/edit-link.blade.php"), __DIR__ . "/../../stubs/views/components/edit-link.blade.php");
    }

    private function copyAsset()
    {
        $this->filesystem->copy( base_path("public/astronaut.css"), __DIR__ . "/../../stubs/public/astronaut.css" );
    }
}