<?php

namespace Mstfkhazaal\FilamentValueStore\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\File;

/**
 * @see \Mstfkhazaal\FilamentValueStore\FilamentValueStore
 */
class FilamentValueStore extends Facade
{
    public static function putPermanentEnv($key, $value): void
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            // Read the existing .env file
            $envFileContent = File::get($envPath);

            // Split the content into an array of lines
            $lines = explode("\n", $envFileContent);
            foreach ($lines as &$line) {
                if (str_starts_with($line, $key . '=')) {
                    // Update the value if the key exists
                    $line = $key . '=' . $value;
                }
            }

            // Merge the lines back into a single string
            $newEnvContent = implode("\n", $lines);

            // Write the updated content to the .env file
            File::put($envPath, $newEnvContent);
        }
    }

    protected static function getFacadeAccessor()
    {
        return \Mstfkhazaal\FilamentValueStore\FilamentValueStore::class;
    }
}
