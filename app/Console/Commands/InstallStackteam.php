<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallStackteam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:stackteam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating shortcut for stackteam.sh in /bin...');
        $source = base_path('stackteam.sh');
        $destination = '/bin/stackteam';
        
        if (symlink($source, $destination)) {
            $this->info('Shortcut created successfully.');
            exec("chmod +x $destination");
            $this->info('Permissions changed to executable.');
        } else {
            $this->error('Failed to create shortcut.');
        }
    }
}
