<?php

namespace App\Services;

use Illuminate\Http\Request;

class TransactionService
{
    // function return all the available providerDataProvider(W/X/Y).
    public function readProviders(): array
    {
        $jsonFilePaths = glob(public_path('*.json'));
        $combinedData = [];
        foreach ($jsonFilePaths as $jsonFilePath) {
            // Read the JSON file contents into a string
            $jsonString = file_get_contents($jsonFilePath);

            // Convert the JSON string to an array using the json_decode function
            $jsonData = json_decode($jsonString, true);

            // Merge the current JSON data into the combined data array
            $combinedData = array_merge($combinedData, $jsonData);
        }
        return $combinedData;
    }
}

if(!function_exists('public_path'))
{
    /**
     * Return the path to public dir
     * @param string|null $path
     * @return string
     */
    function public_path(string $path = ''): string
    {
        return base_path('public') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
