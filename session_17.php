<?php

// ❌ NOT RECOMMENDED APPROACH (shown for learning purposes)
//
// This method loads the entire file into memory at once.
// It can be inefficient or unsafe for large files.

// Read the entire CSV file as a single string
$all_zips = file_get_contents("zipcodes_num_fr_2025.csv");

// Split the string into an array of lines using newline as separator
$zip_lines = explode("\n", $all_zips);

// Display the second line (index 1) for debugging
var_dump($zip_lines[1]);

// Stop execution
die;


// ✅ RECOMMENDED APPROACH (line-by-line processing)
// This is more memory-efficient, especially for large files.

try {

    // Open the CSV file in read mode
    $zip_codes = fopen("zipcodes_num_fr_2025.csv", "r");

    // Open (or create) the SQL output file in write mode
    $migration_sql = fopen('locus.sql', 'w');

    // Skip the first line (CSV header)
    fgets($zip_codes);

    // Read the file line by line
    while ($line = fgets($zip_codes)) {

        // Split the line into columns using comma delimiter
        $line = explode(',', $line);

        // First column: zip code
        $zip_code = $line[0];

        // Fourth column: locality (clean quotes and newline)
        $localite = trim($line[3], "\"\n");

        // Validate data
        if (empty($zip_code) || empty($localite)) {
            var_dump($line);
            die('EMPTY ZIP OR LOCALITE');
        }

        // Build SQL INSERT statement
        $insert = 'INSERT INTO `locus` (`code`, `localite`) VALUES ('
            . $zip_code . ', "' . $localite . '");' . PHP_EOL;

        // Write query to file
        $res = fputs($migration_sql, $insert);
    }
}
finally {
    // Always close opened files

    fclose($zip_codes);
    fclose($migration_sql);
}
