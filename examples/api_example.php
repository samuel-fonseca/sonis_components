<?php
// include autoload for classes
require __DIR__ . '/../src/autoload.php';

// for a list of components go to https://sonis.example.com/cfc/COMPONENT_NAME.cfc
$comp = 'CFC.biographic';
// methods are in each component's page
$meth = 'namesearch';
// declare whether or not you want a return value (yes|no)
$hasReturnVariable = 'yes';
# setup argumentdata with scructure arrays
$argumentdata = biographic::namesearch( 'AB1234567' );

// class params are built:
// # component
// # method
// # hasReturnVariable
// # argumentdata
// init sonis class
$sonis = new sonis(
    $comp,
    $meth,
    $hasReturnVariable,
    $argumentdata
);

// performing the call use `_sonis_api()` function
// you can specify whether you are using the API
// or SQL calls; however, the function will determine
// whether it is a SQL call or API based on an array
// or string input for argumentdata.
$call = $sonis->_sonis_api( 'api' );

var_dump($call); # <----- PRINT OUT THE RESULTS
