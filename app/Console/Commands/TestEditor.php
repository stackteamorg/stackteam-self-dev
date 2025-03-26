<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestEditor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

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
        // Execute the Typora command to open test.md file
        $command = 'typora ~/test.md';
        $this->info("Executing: {$command}");
        
        // Execute the command
        $returnCode = 0;
        exec($command, $output, $returnCode);
        exec('clear', $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error("Failed to execute Typora command. Return code: {$returnCode}");
            return 1; // Command failed
        }
        
        
        $this->info("Terminal screen cleared.");
        // Read and display the content of the test.md file
        $filePath = '~/test.md';
        $expandedPath = str_replace('~', $_SERVER['HOME'], $filePath);
        
        if (file_exists($expandedPath)) {
            $fileContent = file_get_contents($expandedPath);
            $this->info("Content of test.md file:");
            $this->line($fileContent);
        } else {
            $this->warn("File not found: {$expandedPath}");
        }

        $this->info("Typora opened successfully.");
    }
}
