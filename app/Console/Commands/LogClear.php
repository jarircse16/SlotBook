<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LogClear extends Command
{
    protected $signature = 'log:clear';
    protected $description = 'Clear the application log files and caches without affecting user sessions';

    public function handle()
    {
        // Clear log files
        $logFiles = glob(storage_path('logs/*.log'));
        $this->clearFiles($logFiles);

        // Clear Laravel cache files. Be cautious about what exactly you are deleting here.
        $cacheFiles = glob(storage_path('framework/cache/data/*'));
        // Depending on your cache configuration, this might need to be adjusted
        foreach ($cacheFiles as $file) {
            if (is_file($file)) {
                unlink($file);
            } else {
                // If it's a directory (which it can be in some cache configurations), we may recursively delete files
                $this->deleteDirectory($file);
            }
        }

        $this->info('Logs and cache have been cleared, user sessions are intact.');
    }

    private function clearFiles($files)
    {
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    /**
     * Recursively delete directory.
     *
     * @param string $dir Directory name
     */
    private function deleteDirectory($dir) 
    {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->deleteDirectory("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
