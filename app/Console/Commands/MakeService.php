<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:services {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path('Services');
        $filePath = $servicePath . '/' . $name . '.php';

        if (!File::exists($servicePath)) {
            File::makeDirectory($servicePath, 0755, true);
        }

        if (File::exists($filePath)) {
            $this->error('Service already exists!');
            return false;
        }

        // Şablon dosyasını oku
        $stubPath = resource_path('stubs/service.stub');
        if (!File::exists($stubPath)) {
            $this->error('Service stub file not found!');
            return false;
        }

        // Servis sınıfının içeriği
        $serviceTemplate = <<<EOT
        <?php

        namespace App\Services;

        class {$name}Service
        {
            public function __construct()
            {
                // Initialize service
            }

            // Your methods here
        }
        EOT;
        File::put($filePath, $serviceTemplate);

        $this->info('Service created successfully: ' . $filePath);

        return true;
    }
}
