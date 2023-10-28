<?php
/**
 * User: Zura
 * Date: 8/16/2022
 * Time: 5:26 AM
 */

namespace App\Helpers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

/**
 * Class Cart
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package App\Helpers
 */
class GlobalHelpers
{
    public static function generateCsv($options)
    {
        try {
            $filename = $options['filename'];
            $path = storage_path() . '/app' . $options['path'];

            // check if dir exists otherwise, make directory
            $pathDirs = explode('/', $options['path']);
            $nextpath = storage_path() . "/app";
            foreach ($pathDirs as $dir) {
                $nextpath .= "/$dir";
                Log::info($nextpath);
                if (!File::exists($nextpath)) {
                    File::makeDirectory($nextpath);
                }
            }
            // if (!File::exists($path) || !File::isDirectory($path)) {
            //     File::makeDirectory($path);
            // }

            $file = $path . $filename;
            $handle = fopen($file, 'w+'); // open the file

            // add prepended items
            /* if ($options['prepend']) {
                foreach ($options['prepend'] as $item) {
                    fputcsv($handle, $item);
                }
            } */


            //if $options['data'] has children arrays in it [[],[]], it means we're displaying two table on csv (multiple TH, multiple TR),
            // else one table (one TH, multuple TR)


            if (isset($options['multiTable']) && $options['multiTable']) {
                // add header of the csv
                if (isset($options['header'])) { // from defined header
                    foreach ($options['header'] as $key => $h) {
                        fputcsv($handle, $h);
                        foreach ($options['data'][$key] as $data) {
                            fputcsv($handle, array_values((array) $data));
                        }
                    }
                }
            } else {
                // add header of the csv
                if (isset($options['header'])) { // from defined header
                    foreach ($options['header'] as $h) {
                        fputcsv($handle, $h);
                    }
                }

                foreach ($options['data'] as $data) {
                    fputcsv($handle, array_values((array) $data));
                }
            }


            // Log::info("GlobalHelper::generateCsv : Building csv file :" . sizeof($options['data']) . " rows");

            // Log::info($options['data']);
            // foreach ($options['data'][0] as $data) {
            //     fputcsv($handle, array_values((array) $data));
            // }

            fclose($handle); // close the file

            Log::info("GlobalHelper::generateCsv : Done!");

            return $options['path'] . $filename;
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
    