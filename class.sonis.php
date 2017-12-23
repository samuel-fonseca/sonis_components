<?php
/*
Copyright 2016 Clear Creek Baptist Bible College

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

 ************************************************************
 *
 * Sonis API integration in PHP
 *
 * @author      - Samuel Fonseca <samuel.fonseca@ccbbc.edu>
 * @company     - Clear Creek Baptist Bible College
 * @description - Manage Sonis' built-in API functions
 *
 ************************************************************
 */

class sonis
{

    /**
     * @var string $user
    **/
    private $user; # <-- Login username for SuperUser on Sonis

    /**
     * @var string $pass
    **/
    private $pass; # <-- Login password for SuperUser on Sonis

    /**
     * @var string $comp
    **/
    protected $comp;

    /**
     * @var string $meth
    **/
    protected $meth;

    /**
     * @var string $hasReturnVariable (yes/no)
    **/
    protected $hasReturnVariable;

    /**
     * @var array $argumentdata
    **/
    protected $argumentdata;

    /**
     * @var string url will hold the URL for Sonis
    **/
    protected $url;


    /**
     * __construct class to setup call arguments
     *
     * Setting up the call sets the URL to config
     * file and it also sets the admin username and
     * password which are going to be used for the
     * API. This is all setup in config file.
     *
     * @var string $comp holds the component for the call
     * @var string $meth holds the method of the component
     * @var string $hasReturnVariable yes/no if wanted return value
     * @var array $argumentdata holds the arguments for the component
     */
    public function __construct( $comp = '', $meth = '', $hasReturnVariable = '', $argumentdata = '' )
    {
        // before doing anything get user config
        $config = parse_ini_file( 'temp.config.ini' );
        // setup url
        $this->url  = $config['url'];

        // setup Sonis user credentials
        $this->user = $config['user'];
        $this->pass = $config['pass'];

        // now set the params for the call
        $this->comp = $comp;
        $this->meth = $meth;
        $this->hasReturnVariable = $hasReturnVariable;
        $this->argumentdata = $argumentdata;
    }

    /**
     * Set required component for call
     */
    public function setComp( $comp )
    {
        $this->comp = $comp;
    }

    /**
     * Get component being used for call
     */
    public function getComp()
    {
        return $this->comp;
    }

    /**
     * Set wanted method from the component
     */
    public function setMeth( $meth )
    {
        $this->meth = $meth;
    }

    /**
     * Get method being used for call
     */
    public function getMeth()
    {
        return $this->meth;
    }

    /**
     * set return variable to 'yes' or 'no'
     */
    public function setHasReturnVariable( $hasReturnVariable )
    {
        $this->hasReturnVariable = $hasReturnVariable;
    }

    /**
     * Get value of returnVariable
     */
    public function getHasReturnVariable()
    {
        return $this->hasReturnVariable;
    }

    /**
     * Set argumentdata for the call
     */
    public function setArgumentdata( $argumentdata )
    {
        $this->argumentdata = $argumentdata;
    }

    /**
     * Get argumentdata being used for call
     */
    public function getArgumentdata()
    {
        return $this->argumentdata;
    }

    /**
     * public _sonis_api - this function will take all the
     * necessary steps to init the client and complete the
     * SOAP API call, it will also handle errors.
     *
     * @var $api_or_sql tells the script whether to run the API or SQL command
     * @return array with user data, or error information
    **/
    public function _sonis_api ( $api_or_sql = '' )
    {
        // if $argumentdata is an array we assume it's an API call
        // if it is not an array, then it must be a sql query
		if( $api_or_sql == '' )
		{
			$api_or_sql = (is_array($this->argumentdata)) ? 'api' : 'sql';
		}

        // before making call check for sonis
        // call `is_sonis_up` function which will
        // return bool(true) if it's up; else
        // it will return array with error code/message
        $make_call = $this->is_sonis_up();

        if( $make_call )
        {
            // connection is up... So we send good data
            $soap = $this->_sonis_make_soap_call( $api_or_sql, $this->argumentdata );
            // return pretty value
            return $this->handle_obj( $soap );
        }
        else
        {
            // if connection is down set to false
            return $make_call;
        }
    }


    /**
     * protected _sonis_setup_soap
     *
     * @var $callType (api|sql)
     * @returns SoapClient
    **/
    protected function _sonis_setup_soap($callType)
    {
        // set url to point to sonis
        $url = $this->correct_url( $this->url ) . '/cfc/';
        // run a switch call and select url
        switch($callType)
        {
            case 'api': $url .= 'soapapi.cfc'; break; # SOAP API file
            case 'sql': $url .= 'soapsql.cfc'; break; # SOAP SQL file
        }

        $opts = array(
            'ssl' => array(
                'ciphers' => 'RC4-SHA',
                'verify_peer' => false,
                'verify_peer_name' => false
            )
        );
        try
        {
            // try to create a SoapClient
            $client = new SoapClient(
                $url . '?wsdl',
                array(
                    'encoding'              => 'UTF-8',
                    'trace'                 => 1,
                    'features'              => SOAP_SINGLE_ELEMENT_ARRAYS,
                    'connection_timeout'    => 180, # 30 seconds before connection times out (slow connections)
                    'cache_wsdl'            => WSDL_CACHE_MEMORY, # cache the results in the memory
                    'verifypeer'            => false,
                    'verifyhost'            => false,
                    'exceptions'            => 1,
                    'stream_context'        => stream_context_create($opts)
                )
            );
        }
        catch(Exception $e)
        {
            return array('error' => 'Something went wrong with the call: ' . $e);
        }

        return $client;
    }

    /**
     * protected _sonis_make_soap_call
     *
     * This is where to make the call, it is fairly
     * simple. Run through the code and the script
     * should figure out if we are looking for a sql
     * or API call - you can also define either.
     *
     * @var $callType (api|sql)
     * @var $sql_or_argumentdata array|string for API
     * @returns requested data
    **/
    protected function _sonis_make_soap_call($callType, $sql_or_argumentdata)
    {
        try # try to make the call!
        {
            if ($callType == 'api' || $callType == 'sql')
            {

                // if it's SQL or API create our SOAPClient
                $soap = $this->_sonis_setup_soap( $callType );

                // returned value of SoapClient
                if ($soap)
                {
                    if( $callType == 'sql' )
                    {
                        // sql call
                        $result = $soap->__soapCall('doSQLSomething', array(
                            'user' => $this->user,
                            'pass' => $this->pass,
                            'sql' => $sql_or_argumentdata
                        ));
                    }
                    else
                    {
                        // api call
                        $result = $soap->__soapCall('doAPISomething', array(
                            'user' => $this->user,
                            'pass' => $this->pass,
                            'comp' => $this->comp,
                            'meth' => $this->meth,
                            'hasReturnVariable' => $this->hasReturnVariable,
                            'argumentdata' => $sql_or_argumentdata
                        ));
                    }
                }
            }
            else
            {
                return array('error' => 'Bad arguments passed');
            }
        }
        catch(Exception $e)
        {
            return array('error' => 'There was a problem. ' . $e);
        }

        return $result; // call is correct
    }


    /**************************************************
     *
     *  Private functions. Navigate at your own risk
     *
    **************************************************/

    /**
     * Sonis returns errors in strings, thus, this function to convert the string into an array
     *
     * @var string $string holds the error
     * @return array $result (error code/message/explanation)
     */
    private function parseErrorString( $string )
    {
        // create delimiters here
        $delimiters = array('-', "\r\n", "\n", "\r", "chr(13)");
        // start by replacing the $delimiters
        $ready = str_replace( $delimiters, $delimiters[0], $string );

        // create new list() item:
        // $key => $value
        try
        {
            list( $err_typ,     $err_typ_cont,
                  $err_mess,    $err_mess_cont,
                  $err_det,     $err_det_cont ) = explode( $delimiters[0], $ready );
        }
        catch(Exception $e)
        {
            echo 'Oh noe: ', $e->getMessage();
        }

        $result[ trim( $err_typ ) ]     = trim ( $err_typ_cont );
        $result[ trim( $err_mess ) ]    = trim ( $err_mess_cont );
        $result[ trim( $err_det ) ]     = trim ( $err_det_cont );

        return $result;
    }

    /**
     * Remove blank space in the results from Sonis
     *
     * @var $value string for array items
     */
    private function trim_array_values( &$value )
    {
        $value = trim( $value );
    }

    /**
     * array_combine_duplicates will solve issue of duplicate
     * rows being returned by Sonis
     *
     * @var $keys array key
     *
     * Credit: http://php.net/manual/en/function.array-combine.php#118397
     */
    private function array_combine_duplicates($keys, $values)
    {
        $result = array();

        foreach ($keys as $i => $k)
        {
            $result[$k][] = $values[$i];
        }

        array_walk($result, function(&$v){
            $v = (count($v) == 1) ? array_pop($v): $v;
        });

        return $result;
    }

    /**
     * Instead of sending an ugly mess to our users
     * separate array in a beautiful arrangment
     *
     * @var array $array is either an object or an array (usually sonis will send an object)
     */
    private function handle_obj( $array )
    {
        // if it's an object we treat it as such
        if ( is_object( $array ) )
        {
            // reduce array->data to simpler format
            $call_data = array_reduce( $array->data, 'array_merge', [] );
            // trim array values
            $call_data = array_map ( 'trim', $call_data );

            // count each array and make sure they have the same number
            if ( count($array->columnList) == count( $call_data ) )
            {
                // combine both arrays
                $combine = $this->array_combine_duplicates ( $array->columnList, $call_data );
            }
            else
            {
                if ( count($array->data) > 0 )
                {
                    foreach( $array->data as $column => $data )
                    {
                        $combine[] = $this->array_combine_duplicates ( $array->columnList, $data );
                    }
                }
                else
                {
                    $combine = $array;
                }
            }

        }
        // if it's not an object, treat it as array.
        else if ( is_array( $array ) )
        {
            // first check for data key
            if( array_key_exists('data', $array) )
            {
                // make sure there's one or more entries
                if ( $array['data'] >= 1 )
                {
                    // split array
                    array_splice($array['data'], 1);
                }
                // reduce array->data to simpler format
                $call_data = array_reduce( $array['data'], 'array_merge', [] );
                // combine both arrays
                $combine = array_combine ( $call['columnList'], $call_data );

                $combine = array_map('trim', $combine );
                $combine = array_change_key_case($combine, CASE_LOWER);
            }
            else
            {
                if ( count($array['data']) > 0 ) # check to see if there's anything inside of data object
                {
                    foreach( $array['data'] as $column => $data )
                    {
                        $combine[] = array_combine( $array['columnList'], $data );
                    }
                }
                else # if there's nothing return the default array
                {
                    $combine = $array;
                }
            }
        }
        else
        {
            // check if it's string and if contains `Error`
            if( is_string($array) && strpos($array, 'Error') )
            {
                // convert the error into an array
                $combine = $this->parseErrorString( trim($array) );
                // log our error
                error_log( $array );
            }
            else
            {
                // if it's a string but it does not
                // have `error` than it can be something
                // else.
                // also: good fall-back
                $combine = $array;
            }
        }

        return $combine;
    }

    /**
     * Check Sonis domain and make sure we get a good response (200)
     *
     * @return bool(true) || error message
     */
    public function is_sonis_up()
    {
        // init connection
        $handle = curl_init($this->url);
        // set options for cURL connection
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        // execute cURL
        $response = curl_exec( $handle );
        // response code
        $httpResponse = curl_getinfo( $handle, CURLINFO_HTTP_CODE );
        // if response is not 200, service is down
        if( $httpResponse != 200 )
        {
            // run switch to create different error messages
            switch( $httpResponse )
            {
                // invalid
                case 400:
                    $message = array(
                        'sonis_down' => true,
                        'is_error' => 'danger',
                        'code' => $httpResponse,
                        'message' => 'Invalid Request. Try again later.'
                    );
                    break;
                // not found
                case 404:
                    $message = array(
                        'sonis_down' => true,
                        'is_error' => 'danger',
                        'code' => $httpResponse,
                        'message' => 'Location not found! Contact the administrator.'
                    );
                    break;
                // server error
                case 500:
                    $message = array(
                        'sonis_down' => true,
                        'is_error' => 'danger',
                        'code' => $httpResponse,
                        'message' => 'This is embarrassing. Server error.'
                    );
                    break;
                // server is down
                case 502:
                    $message = array(
                        'sonis_down' => true,
                        'is_error' => 'danger',
                        'code' => $httpResponse,
                        'message' => 'Server is down. Try again later.'
                    );
                    break;
                // server is not available
                case 503:
                    $message = array(
                        'sonis_down' => true,
                        'is_error' => 'danger',
                        'code' => $httpResponse,
                        'message' => 'Services are currently unavailable.'
                    );
                    break;
                // anything else
                default:
                    $message = array(
                        'sonis_down' => true,
                        'is_error' => 'danger',
                        'code' => $httpResponse,
                        'message' => 'Unknown SOAP Service Error: ' . $httpResponse
                    );
                    break;
            }
            // log the error
            error_log( $message['message'] );
            // return false
            return $message;
        }
        else
        {
            // if server is up return true
            return true;
        }
        // close curl connection
        curl_close();
    }

    /**
     * Remove trailing slash from URL
     *
     * @var $url holds Sonis' url
     * @return $url without forward slash (if any)
     */
    private function correct_url( $url )
    {
        $last_char = substr( $url, -1 );
        if( $last_char == '/' )
        {
            $url = preg_replace( '{/$}', '', $url );
        }
        return $url;
    }
}
