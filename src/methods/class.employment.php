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

class employment
{
    public static function insert_employment( $soc_sec = '', $emp_emply = '', $emp_super = '', $emp_add1 = '', $emp_add2 = '', $emp_add3 = '', $emp_city = '', $emp_state = '', $emp_county = '', $emp_zip = '', $employ_type_rid = '', $emp_pos = '', $hrs_week = '', $start_dt = '', $stop_dt = '', $emp_mem = '', $emp_rid = '', $empcountry = 'USA', $when_code = 'PTE', $emp_phone = '', $homeinst = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('emp_emply', $emp_emply),
            array('emp_super', $emp_super),
            array('homeinst', $homeinst),
            array('emp_add1', $emp_add1),
            array('emp_add2', $emp_add2),
            array('emp_add3', $emp_add3),
            array('emp_city', $emp_city),
            array('emp_state', $emp_state),
            array('emp_county', $emp_county),
            array('empcountry', $empcountry),
            array('emp_zip', $emp_zip),
            array('emp_pos', $emp_pos),
            array('emp_phone', $emp_phone),
            array('start_dt', $start_dt),
            array('stop_dt', $stop_dt),
            array('when_code', $when_code),
            array('hrs_week', $hrs_week),
            array('employ_type_rid', $employ_type_rid),
            array('emp_mem', $emp_mem),
            array('emp_rid', $emp_rid)
        );
        return $response;
    }

    public static function search( $soc_sec = '', $emp_rid = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('emp_rid', $emp_rid),
        );
        return $response;
    }

    public static function delete_employment( $emp_rid )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('emp_rid', $emp_rid),
        );
        return $response;
    }
}
