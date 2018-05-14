<?php
// include autoload for classes
require __DIR__ . '/../src/autoload.php';

# setup argumentdata with simple sql function
$argumentdata = 'SELECT * FROM dbo.table_NAME';

// init sonis class
$sonis = new sonis();
// call specific function
$sonis->setArgumentdata($argumentdata);

// performing the call use `_sonis_api()` function
// you can specify whether you are using the API
// or SQL calls; however, the function will determine
// whether it is a SQL call or API based on an array
// or string input for argumentdata.
$call = $sonis->_sonis_api( 'sql' );

var_dump($call); # <----- PRINT OUT THE RESULTS
