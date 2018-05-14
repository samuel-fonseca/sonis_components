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

class biographic
{
    public static function namesearch( $soc_sec = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec) # required
        );
        return $response;
    }


    public static function save_biographic( $soc_sec, $mod_stat = '', $first_name = '', $last_name = '', $mi = '', $acadstat_cod = '', $prefix = '', $suffix = '', $maiden = '', $nickname = '', $birthdate = '', $gender = '', $ssn = '', $old_ssn = '', $affiliation_cod = '', $citizen = '', $ethnic_cod = '', $mar_cod = '', $transmem = '', $veteran = '', $releas_inf = '', $releas_dt = '', $div_cod = '', $dept_cod = '', $camp_cod = '', $level_ = '', $tuit_stat = '', $name_mem = '', $pin = '', $newpin = '', $deceased = '', $dec_date = '', $exam_id = '', $online_hld = '', $notpubname = '', $show_email = '', $show_phone = '', $show_addr = '', $show_wkphn = '', $excl_billing = '', $excl_mailing = '', $other_name = '', $fund_stat = '', $photo = '', $iped_stat = '', $operator = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec), # required
            array('mod_stat', $mod_stat),
            array('first_name', $first_name),
            array('last_name', $last_name),
            array('mi', $mi),
            array('acadstat_cod', $acadstat_cod),
            array('prefix', $prefix),
            array('suffix', $suffix),
            array('maiden', $maiden),
            array('nickname', $nickname),
            array('birthdate', $birthdate),
            array('gender', $gender),
            array('ssn', $ssn),
            array('old_ssn', $old_ssn),
            array('affiliation_cod', $affiliation_cod),
            array('citizen', $citizen),
            array('ethnic_cod', $ethnic_cod),
            array('mar_cod', $mar_cod),
            array('transmem', $transmem),
            array('veteran', $veteran),
            array('releas_inf', $releas_inf),
            array('releas_dt', $releas_dt),
            array('div_cod', $div_cod),
            array('dept_cod', $dept_cod),
            array('camp_cod', $camp_cod),
            array('level_', $level_),
            array('tuit_stat', $tuit_stat),
            array('name_mem', $name_mem),
            array('pin', $pin),
            array('newpin', $newpin),
            array('deceased', $deceased),
            array('dec_date', $dec_date),
            array('exam_id', $exam_id),
            array('online_hld', $online_hld),
            array('notpubname', $notpubname),
            array('show_email', $show_email),
            array('show_phone', $show_phone),
            array('show_addr', $show_addr),
            array('show_wkphn', $show_wkphn),
            array('excl_billing', $excl_billing),
            array('excl_mailing', $excl_mailing),
            array('other_name', $other_name),
            array('fund_stat', $fund_stat),
            array('photo', $photo),
            array('iped_stat', $iped_stat),
            array('operator', $operator)

        );

        return $response;
    }

    public static function create_biographic( $first_name, $last_name, $birthdate, $preferred = '', $st_addr = '', $add_addr = '', $add_add2 = '', $city = '', $state = '', $zip = '', $phone = '', $cell_phone = '', $fax = '', $e_mail = '', $work_phone = '', $county_cod = '', $country = '', $mod_stat = '', $mi = '', $prefix = '', $suffix = '', $maiden = '', $nickname = '', $gender = '', $ssn = '', $affiliation_cod = '', $citizen = '', $ethnic_cod = '', $mar_cod = '', $transmem = '', $veteran = '', $releas_inf = '', $releas_dt = '', $div_cod = '', $dept_cod = '', $camp_cod = '', $level_ = '', $tuit_stat = '', $name_mem = '', $pin = '', $newpin = '', $deceased = '', $dec_date = '', $exam_id = '', $online_hld = '', $notpubname = '', $show_email = '', $show_phone = '', $show_addr = '', $show_wkphn = '', $excl_billing = '', $excl_mailing = '', $fund_stat = '', $photo = '', $iped_stat = '', $operator = '', $address_ce1 = '', $address_ce2 = '', $address_ce3 = '', $address_le1 = '', $address_ne1 = '', $address_de1 = '', $address_fe1 = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('mod_stat', $mod_stat),
            array('first_name', $first_name), # required
            array('last_name', $last_name), # required
            array('mi', $mi),
            array('prefix', $prefix),
            array('suffix', $suffix),
            array('maiden', $maiden),
            array('nickname', $nickname),
            array('birthdate', $birthdate), # required
            array('gender', $gender),
            array('ssn', $ssn),
            array('affiliation_cod', $affiliation_cod),
            array('citizen', $citizen),
            array('ethnic_cod', $ethnic_cod),
            array('mar_cod', $mar_cod),
            array('transmem', $transmem),
            array('veteran', $veteran),
            array('releas_inf', $releas_inf),
            array('releas_dt', $releas_dt),
            array('div_cod', $div_cod),
            array('dept_cod', $dept_cod),
            array('camp_cod', $camp_cod),
            array('level_', $level_),
            array('tuit_stat', $tuit_stat),
            array('name_mem', $name_mem),
            array('pin', $pin),
            array('newpin', $newpin),
            array('deceased', $deceased),
            array('dec_date', $dec_date),
            array('exam_id', $exam_id),
            array('online_hld', $online_hld),
            array('notpubname', $notpubname),
            array('show_email', $show_email),
            array('show_phone', $show_phone),
            array('show_addr', $show_addr),
            array('show_wkphn', $show_wkphn),
            array('excl_billing', $excl_billing),
            array('excl_mailing', $excl_mailing),
            array('fund_stat', $fund_stat),
            array('photo', $photo),
            array('iped_stat', $iped_stat),
            array('operator', $operator),
            array('preferred', $preferred),
            array('st_addr', $st_addr),
            array('add_addr', $add_addr),
            array('add_add2', $add_add2),
            array('city', $city),
            array('state', $state),
            array('zip', $zip),
            array('phone', $phone),
            array('cell_phone', $cell_phone),
            array('fax', $fax),
            array('e_mail', $e_mail),
            array('work_phone', $work_phone),
            array('county_cod', $county_cod),
            array('country', $country),
            array('address_ce1', $address_ce1),
            array('address_ce2', $address_ce2),
            array('address_ce3', $address_ce3),
            array('address_le1', $address_le1),
            array('address_ne1', $address_ne1),
            array('address_de1', $address_de1),
            array('address_fe1', $address_fe1)
        );
        return $response;
    }

    public static function update_decriptive( $soc_sec = '', $photo = '', $ssn = '', $gender = '', $ethnic_cod = '', $birthdate = '', $mod_stat = '', $acadstat_cod = 'TBD', $affiliation_cod = '', $citizen = '', $mar_cod = '', $veteran = '', $deceased = '', $dec_date = '', $dl_state = '', $memo = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('ssn', $ssn),
            array('mod_stat', $mod_stat),
            array('gender', $gender),
            array('acadstat_cod', $acadstat_cod),
            array('affiliation_cod', $affiliation_cod),
            array('citizen', $citizen),
            array('ethnic_cod', $ethnic_cod),
            array('mar_cod', $mar_cod),
            array('veteran', $veteran),
            array('deceased', $deceased),
            array('dec_date', $dec_date),
            array('photo', $photo),
            array('dl_state', $dl_state),
            array('birthdate', $birthdate),
            array('memo', $memo)
        );
        return $response;
    }


    public static function update_decriptive__photo( $soc_sec = '', $photo = '', $acadstat_cod = 'TBD', $ssn = '', $gender = '', $ethnic_cod = '', $birthdate = '', $mod_stat = '', $affiliation_cod = '', $citizen = '', $mar_cod = '', $veteran = '', $deceased = '', $dec_date = '', $dl_state = '', $memo = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('ssn', $ssn),
            array('mod_stat', $mod_stat),
            array('gender', $gender),
            array('acadstat_cod', $acadstat_cod),
            array('affiliation_cod', $affiliation_cod),
            array('citizen', $citizen),
            array('ethnic_cod', $ethnic_cod),
            array('mar_cod', $mar_cod),
            array('veteran', $veteran),
            array('deceased', $deceased),
            array('dec_date', $dec_date),
            array('photo', $photo),
            array('dl_state', $dl_state),
            array('birthdate', $birthdate),
            array('memo', $memo)
        );
        return $response;
    }
}
