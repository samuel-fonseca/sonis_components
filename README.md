# Sonis Components
I hope to be able to inform new-comers to Sonis API development, and give some insight on what I have learned about their systems. The beginning can be a bit complicated, but once the you understand the ins and outs of the Sonis API you will be better off and save a lot of debugging time.

## Compability
> (PHP 5, PHP 7)
This class has been tested with both PHP 5.6.0 & 7.1.0

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
Now, I am going to make a case why my class is better than just using PHP's built-in SOAP calls.

I typed up a quick example, this should give you an idea of what you need to send to the server. However, this is somewhat limited, for exhaustive tests and examples I have to create a new file; this is just a comparison.

### doAPISomething
Begin with the most common call type, `doAPISomething`; it will be the easiest to just call the available components and their methods.

```php
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

Now that's wonderfully long, and prone to errors; It's also not very replicable. You could easily put this into a function, but the function would not be very mutable, leading to more issues of compability;

Nonetheless, with the Sonis class your code would look like this:

```php
# call arguments
$comp = 'CFC.component';    # cfc component
$meth = 'method';           # method within given component
$hasReturnVariable = 'yes'; # / or 'no'
$argumentdata = component::method(example, example, /* ... */);
# init the client and perform call using `_sonis_api('api|sql')`
$client = new sonis($comp, $meth, $hasReturnVariable, $argumentdata);
$call = $client->_sonis_api( 'api' );
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

For SQL queries you would only have to pass a SQL string:

```php
$argumentdata = component::method(example, example, /* ... */);

$client = new sonis('', '', '', $argumentdata);
$call = $client->_sonis_api( 'sql' );
```

I will eventually shift `$argumentdata` to the first argument since it is the one argument used for both `doAPISomething` and `doSQLSomething`. This is TBD, though.

So there is a clear winner here; Using the class for the API only requires a few lines of code without the extensive reuse of `constants`.

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

My class will return a 2d array with the `KEY` and the `VALUE`. I also handle duplicate keys - which, I promise you, do happen.

```
Array
(
    [UNIQUE_KEY] => VALUE
    [DUPLICATE_KEY] => Array
    (
        [0] => VALUE1
        [1] => VALUE2
    )
    [UNIQUE_KEY] => VALUE
    [UNIQUE_KEY] => VALUE
    /**...**/
)
```
This is easier to handle, and it takes less hussle to try and put Keys with their paired values.

# Errors

All Sonis errors will return in `string`; so if you call a bad method or the data passed is incorrect you receive a `string` back.

Moreover, I do fix this string to a simple 2d `array` using the class when passing the results back; I also log that string error; so if that ever happens you will have the error logged in your error logs.

```
Error Type - [THE MAIN CAUSE]
Error Message - [ERROR MESSAGE GOES HERE]
Error Detail - [SOME DEBUGGING HELP, OR MORE DETAILED INFORMATION]
```
