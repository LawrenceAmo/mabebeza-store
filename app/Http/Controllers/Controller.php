<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function arrayToObject(array $data) {
        $data = $data[0];

        // Get the keys from the first sub-array
        $keys = $data[0];
        
        // Initialize an empty array to store objects
        $objects = [];

        // Iterate over the remaining sub-arrays
        for ($i = 1; $i < count($data); $i++) {
            $values = $data[$i];

            // Check if the number of keys and values match
            if (count($keys) !== count($values)) {
                return (object)[]; // Return an empty object or handle the error as needed
            }

            $associativeArray = [];

            foreach ($keys as $index => $key) {
                $associativeArray[$key] = $values[$index];
            }

            // Cast the associative array to an object and store it in the array of objects
            $objects[] = (object)$associativeArray;
        }

        return $objects;              
    }
}
