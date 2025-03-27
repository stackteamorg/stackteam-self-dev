<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--filename= : Output file name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate SQL output from the entire database and save it to the selected path';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get database information from config file
        $driver = Config::get('database.default');
        $connection = Config::get("database.connections.$driver");
        
        if (!in_array($driver, ['mysql', 'pgsql'])) {
            $this->error("The driver $driver is not supported. Please use MySQL or PostgreSQL.");
            return 1;
        }
        
        // Default filename for output
        $defaultFilename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filename = $this->option('filename') ?: $defaultFilename;
        
        // Create a temporary file to store SQL output
        $tempFilePath = storage_path('app/' . $filename);
        
        $this->info('Generating SQL output from the database...');
        
        try {
            // Select the appropriate command based on the database type
            if ($driver === 'mysql') {
                $command = [
                    'mysqldump',
                    '--host=' . $connection['host'],
                    '--port=' . $connection['port'],
                    '--user=' . $connection['username'],
                    '--password=' . $connection['password'],
                    $connection['database'],
                ];
            } else if ($driver === 'pgsql') {
                // Set the PGPASSWORD environment variable for the pg_dump command
                putenv('PGPASSWORD=' . $connection['password']);
                
                $command = [
                    'pg_dump',
                    '--host=' . $connection['host'],
                    '--port=' . $connection['port'],
                    '--username=' . $connection['username'],
                    '--dbname=' . $connection['database'],
                    '--format=p', // plain text format
                    '--file=' . $tempFilePath,
                ];
            }
            
            if ($driver === 'mysql') {
                // For MySQL, we need to redirect the output to a file
                $process = new Process($command);
                $process->setWorkingDirectory(base_path());
                $process->run();
                
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                
                // Save output to temporary file
                File::put($tempFilePath, $process->getOutput());
            } else {
                // For PostgreSQL, the pg_dump command creates the file directly
                $process = new Process($command);
                $process->setWorkingDirectory(base_path());
                $process->run();
                
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
            }
            
            $this->info('SQL output successfully created!');
            $this->info('Opening file save dialog...');
            
            // Detect the operating system and select the appropriate command to open the file dialog
            $os = PHP_OS;
            
            if (strtoupper(substr($os, 0, 3)) === 'WIN') {
                // Windows
                $saveCommand = 'powershell -Command "Add-Type -AssemblyName System.Windows.Forms; ' .
                    '$saveFileDialog = New-Object System.Windows.Forms.SaveFileDialog; ' .
                    '$saveFileDialog.Filter = \'SQL Files (*.sql)|*.sql\'; ' .
                    '$saveFileDialog.Title = \'Save SQL Output\'; ' .
                    '$saveFileDialog.FileName = \'' . $filename . '\'; ' .
                    'if ($saveFileDialog.ShowDialog() -eq \'OK\') { $saveFileDialog.FileName };"';
                    
                $process = new Process(['cmd', '/c', $saveCommand]);
            } elseif ($os === 'Darwin') {
                // macOS
                $saveCommand = 'osascript -e \'tell application "System Events"
                    activate
                    set theFile to choose file name with prompt "Save SQL Output" default name "' . $filename . '"
                    return POSIX path of theFile
                end tell\'';
                
                $process = new Process(['bash', '-c', $saveCommand]);
            } else {
                // Linux (requires zenity)
                $this->info('Note: If the file dialog command does not work, please check if the zenity package is installed.');
                $saveCommand = 'zenity --file-selection --save --confirm-overwrite --title="Save SQL Output" --filename="' . $filename . '"';
                
                $process = new Process(['bash', '-c', $saveCommand]);
            }
            
            $process->setWorkingDirectory(base_path());
            $process->run();
            
            if (!$process->isSuccessful()) {
                // If there is an error opening the file dialog, suggest the user copy the file from the temporary path
                $this->error('Error opening file selection window. SQL output has been saved at the following path:');
                $this->info($tempFilePath);
                return 1;
            }
            
            $targetPath = trim($process->getOutput());
            
            if (empty($targetPath)) {
                $this->info('File selection canceled. SQL output has been saved at the following path:');
                $this->info($tempFilePath);
                return 0;
            }
            
            // Copy file from temporary path to selected path
            File::copy($tempFilePath, $targetPath);
            
            // Delete temporary file
            File::delete($tempFilePath);
            
            $this->info('SQL output successfully saved at the following path:');
            $this->info($targetPath);
            
        } catch (\Exception $e) {
            $this->error('Error generating SQL output:');
            $this->error($e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
