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

class program
{
    public static function insert_approg($soc_sec = '', $camp_cod = '', $entry_date = '', $prg_cod = '', $d_soc_sec = '', $div_cod = '', $app_date = '', $ack_date = '', $trans_date = '', $is_applicant = 'yes', $preferred = 'yes', $incomplete = '0', $app_rid = '', $ref_source = '', $fee_rec = '0', $apfee_dt = '', $prior_app = '0', $app_yr = '', $acknowledg = '0', $sms_trans = '0', $matric_fee = '0', $degree_ap = '', $degree_ac = '', $major_ap = '', $major_ac = '', $time_maint = '', $date_maint = '', $trans_done = '0', $operator = '', $app_year = '')
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('CurDrive', '#session.CurDrive#'),
            array('soc_sec', $soc_sec),
            array('app_rid', $app_rid),
            array('prg_cod', $prg_cod),
            array('ref_source', $ref_source),
            array('fee_rec', $fee_rec),
            array('apfee_dt', $apfee_dt),
            array('prior_app', $prior_app),
            array('app_yr', $app_yr),
            array('div_cod', $div_cod),
            array('camp_cod', $camp_cod),
            array('app_date', $app_date), # required
            array('entry_date', $entry_date),
            array('incomplete', $incomplete),
            array('acknowledg', $acknowledg),
            array('ack_date', $ack_date), # required
            array('sms_trans', $sms_trans),
            array('trans_date', $trans_date), # required
            array('matric_fee', $matric_fee),
            array('degree_ap', $degree_ap),
            array('degree_ac', $degree_ac),
            array('major_ap', $major_ap),
            array('major_ac', $major_ac),
            array('time_maint', $time_maint),
            array('date_maint', $date_maint),
            array('trans_done', $trans_done),
            array('operator', $operator),
            array('is_applicant', $is_applicant),
            array('preferred', $preferred)
        );
        return $response;
    }

    public static function delete_approg( $app_rid = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('app_rid', $app_rid)
        );

        return $response;
    }

    public static function approgsearch( $soc_sec )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec)
        );

        return $response;
    }

    public static function preventrepeats( $soc_sec = '', $prg_cod = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('prg_cod', $prg_cod)
        );

        return $response;
    }

    public static function complete_app( $soc_sec = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec)
        );

        return $response;
    }

    public static function programSearch( $soc_sec = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec)
        );

        return $response;
    }
}
