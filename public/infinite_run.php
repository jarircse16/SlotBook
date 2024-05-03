<?php

set_time_limit(0);  // Allow infinite execution time

ignore_user_abort(true); // Continue running the script even if the CLI session is terminated

while (true) {

    $response = file_get_contents('http://127.0.0.1:8085/api/slot-update'); // Fix this line after uploading to hosting...
    
    //$data = json_decode($response, true);

    //echo "Data fetched: " . date('Y-m-d H:i:s') . "\n";

    sleep(20);  // Wait for 20 seconds before the next fetch
}

//Useage: On hosting terminal: php infinite_run.php
