<?php

namespace App\Helpers;

class FileContentParser
{
    /**
     * Parses file's content to an array with provided columns as keys
     *
     * @param $columns
     * @param $file
     * @param string $delimiter
     *
     * @return array
     */
    public static function toArray($columns, $file, $delimiter = ',')
    {
        $data = [];
        
        if (( $handle = fopen($file, 'r') ) !== FALSE) {
            while (( $row = fgetcsv($handle, 1000, $delimiter) ) !== FALSE) {
                abort_if(count($columns) != count($row)
                    , 409,
                    'Your file should contains lines which match these columns ' . implode(",", $columns)
                );
                
                $data[] = array_combine($columns, $row);
            }
            fclose($handle);
        }
        
        return $data;
    }
}
