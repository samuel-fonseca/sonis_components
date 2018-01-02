# Sonis Components
I hope to be able to inform new-comers to Sonis API development, and give some insight on what I have learned about their systems. The beginning can be a bit complicated, but once the you understand the ins and outs of the Sonis API you will be better off and save a lot of debugging time.

## Installation
To begin using sonis take the `/template.config.ini` and replace `user`, `pass`, and `url` to your Sonis server; This should be very simple, and the class will automatically setup the script for you based on those credentials.

Save the new file as `config.ini`; make sure to store this file in a safe location - since your server may not prevent `.ini` files from being read in a standard browser.

## Components, Methods, and Arguments
Making the call is fairly simple. Sonis works with components (ColdFusion) and each component has a set of methods; for each of those methods you have a response and various arguments you can request.

For example, let's look at the `CFC.address` component.

It has 4 methods:

- `add_address`
- `addressSearch`
- `insert_address`
- `update_address`

Each method, here, accomplishes something different in the scope of the `CFC.address` component.

Each of those methods have parameters for you to get what you are looking for - or dump some data on Sonis. For instance, let's look at the `addressSearch` method, since it's has the least requirements:

```php
$argumentdata = array(
    array('sonis_ds', '#sonis.ds#'),
    array('soc_sec', ''), # required
    array('preferred', '')
);
```

These parameters ask for two things:

- `soc_sec`     = The user's ID
- `preferred`   = would you like the preferred address

**NOTE**: Most of the ColdFusion variables do not need to be changed (`sonis_ds`, `MainDir`, etc...). Simply keep the default values between `#`.

## PHP Example
I typed up a quick example, this should give you an idea of what you need to send to the server. However, this is somewhat limited, the best solution is to create a class and make the code reusable with abstraction.

### doAPISomething
```php
<?php
# login information
$user = 'SONIS_USERNAME';
$pass = 'SONIS_PASSWORD';

$comp = 'CFC.component';    # cfc component
$meth = 'method';           # method within given component
$hasReturnVariable = 'yes'; # / or 'no'
$argumentdata = array(
    array('column', 'value'),
    array('column', 'value'),
    array('column', 'value'),
    # ... as many as you need
); # argumentdata has to be setup as seen above

# make SOAP call using PHP built-in SOAP Client
$wsdl = "https://sonis.example.com/cfc/soapapi.cfc?wsdl"; # user your domain
$params = array(
    'connection_timeout' => 5,
    'cache_wsdl' => WSDL_CACHE_NONE
);

# init client
$client = new SoapClient($wsdl, $params);

# make call
$call = $client->__soapCall('doAPISomething', # if you are using the API
                            array(
                                'user' => $username,
                                'pass' => $password,
                                'comp' => $comp,
                                'meth' => $meth,
                                'hasReturnVariable' => $hasReturnVariable,
                                'argumentdata' => $argumentdata
                            ));
?>
```

### doSQLSomething
For sql use `doSQLSomething` and pass only a string (not an array) as the second parameter

```php
<?php
$agumentdata = "SELECT * FROM some_table";

# make call
$call = $client->__soapCall('doSQLSomething', # if you are using the SQL
                            array(
                                'user' => $username,
                                'pass' => $password,
                                'argumentdata' => $argumentdata
                            ));
?>
```

## The responses
If everything in your Sonis server is setup correctly for SOAP API calls your response could be:
   - 1/0 as `true` or `false`
   - data you may have requested - it will return as an object
   
```php
print_r($call);
```
The output is:
```
stdClass Object
(
   [columnList] => Array
   (
       [0] => COLUMN_NAME
   )
   [data] => Array
   (
       [0] => Array # one record for each value response
       (
          [0] => VALUE                   
       )
       # if there are multiple records for the result it will be increment in the `data` object
       [1] => Array
       (
          [0] => VALUE                   
       )
   )
)
```
   
   - errors will return in string
```
Error Type - [THE MAIN CAUSE]
Error Message - [ERROR MESSAGE GOES HERE]
Error Detail - [SOME DEBUGGING HELP, OR MORE DETAILED INFORMATION]
```
