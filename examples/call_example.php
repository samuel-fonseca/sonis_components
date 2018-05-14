<?php
// include autoload for classes
require './autoload.php';

// for a list of components go to https://sonis.example.com/cfc/COMPONENT_NAME.cfc
$comp = 'CFC.biographic';
// methods are in each component's page
$meth = 'namesearch';
// declare whether or not you want a return value (yes|no)
$hasReturnVariable = 'yes';

####################
## doAPISomething ##
####################
// argumentdata comes in the way of a simple 2d array
// $argumentdata = array(
//     array('sonis_ds', '#sonis.ds#'), # sonis_ds is required for all sonis API calls
//     array('MainDir', '#MainDir#'), # MainDir tells Sonis to run the script in the Main Directory of Sonis
//     array('soc_sec', 'AB1234567'), # param needed for specific method
// );
//__________________________________________
// with these classes all you need to do is:
// classes are broken into
// COMPONENT::METHOD ( PARAMS )
$argumentdata = biographic::namesearch( 'AB1234567' );

####################
## doSQLSomething ##
####################
// To perform a sql call simply write a string
// in place of the actual array; this will be
// fairly straight forward with a simple SQL
// understanding.
#################################################
# $argumentdata = 'SELECT * FROM dbo.table_NAME'; # <--- SQL example
#################################################
/* NOTE: If you are using sql, you do not have to
pass extra parameters, you only need to pass the 
sql itself. */


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
$call = $sonis->_sonis_api( 'api' /* || 'sql' */ );

var_dump($call); # <----- PRINT OUT THE RESULTS
