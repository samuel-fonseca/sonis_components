<?php
/*
Copyright 2018 Clear Creek Baptist Bible College

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

class address
{
    /**
     * add_address
     *
     * use this function to create new address record for the user
     */
    public static function add_address( $soc_sec, $preferred, $st_addr = '', $add_addr = '', $add_add2 = '', $city = '', $state = '', $zip = '', $phone = '', $work_phone = '', $county_cod = '', $country = '', $e_mail = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec), # required
            array('preferred', $preferred), # required
            array('st_addr', $st_addr),
            array('add_addr', $add_addr),
            array('add_add2', $add_add2),
            array('city', $city),
            array('state', $state),
            array('zip', $zip),
            array('phone', $phone),
            array('work_phone', $work_phone),
            array('county_cod', $county_cod),
            array('country', $country),
            array('e_mail', $e_mail)
        );
        return $response;
    }

    /**
     * insert_address
     *
     * use this function to insert new address for user
     * required:
     *  soc_sec = user's unique ID
     *  preferred = address can be marked as yes/no preferred (not sure why?????)
     */
    public static function insert_address( $soc_sec, $preferred, $st_addr = '', $add_addr = '', $add_add2 = '', $city = '', $state = '', $zip = '', $phone = '', $cell_phone = '', $work_phone = '', $county_cod = '', $country = '', $e_mail = '', $fax = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec), # required
            array('preferred', $preferred), # required
            array('st_addr', $st_addr),
            array('add_addr', $add_addr),
            array('add_add2', $add_add2),
            array('city', $city),
            array('state', $state),
            array('zip', $zip),
            array('phone', $phone),
            array('cell_phone', $cell_phone),
            array('work_phone', $work_phone),
            array('county_cod', $county_cod),
            array('country', $country),
            array('e_mail', $e_mail),
            array('fax', $fax),
        );
        return $response;
    }

    /**
     * addressSearch()
     *
     * use this function to add new address to user
     * required:
     *  soc_sec = user's unique ID
     */
    public static function addressSearch( $soc_sec, $preferred = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('soc_sec', $soc_sec), # required
            array('preferred', $preferred)
        );
        return $response;
    }
}
