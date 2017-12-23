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

class education
{
    public static function eduSearch( $soc_sec = '', $edu_rid = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('soc_sec', $soc_sec),
            array('edu_rid', $edu_rid),
        );
        return $response;
    }

    public static function institutsearch( $inst_city = '', $inst_state = '', $inst_txt = '', $insttypcod = '', $inst_cntry = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('inst_city', $inst_city),
            array('inst_cntry', $inst_cntry),
            array('inst_state', $inst_state),
            array('inst_txt', $inst_txt),
            array('insttypcod', $insttypcod),
        );
        return $response;
    }

    public static function insert_inst( $soc_sec = '', $inst_mem = '', $edu_rid = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('inst_mem', $inst_mem),
            array('edu_rid', $edu_rid),
        );
        return $response;
    }

    public static function insert_default_education( $soc_sec = '', $cohort_cod = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('CurDrive', '#session.CurDrive#'),
            array('soc_sec', $soc_sec),
            array('cohort_cod', $cohort_cod)
        );
        return $response;
    }

    public static function insert_education( $soc_sec = '', $educmem = '', $inst_cod = '', $mod_stat = '', $degree = '', $enter_date = '', $leav_date = '', $grad_mo = '', $grad_year = '', $graduated = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'), # required
            array('soc_sec', $soc_sec),
            array('inst_txt', $educmem),
            array('inst_cod', $inst_cod),
            array('mod_stat', $mod_stat),
            array('degree', $degree),
            array('enter_date', $enter_date),
            array('leav_date', $leav_date),
            array('grad_mo', $grad_mo),
            array('grad_year', $grad_year),
            array('graduated', $graduated)
        );

        return $response;
    }

    public static function delete_education( $soc_sec = '', $edu_rid = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'), # required
            array('soc_sec', $soc_sec),
            array('edu_rid', $edu_rid)
        );

        return $response;
    }
}
