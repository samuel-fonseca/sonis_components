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

class OAQuestions
{
    /**
     * Insert custom questions in Sonis database
     */
    public static function insert_oa_questions( $soc_sec, $fieldnames )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('CurDrive', '#session.CurDrive#'),
            array('soc_sec', $soc_sec),
            array('fieldnames', $fieldnames)
        );

        return $response;
    }

    /**
     * Search for questions and answers
     */
    public static function oa_questions_search( $soc_sec, $column = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('column_', $column),
        );

        return $response;
    }

    /**
     * Search format of OA questions
     */
    public static function oa_questions_search_format( $soc_sec, $oa_questions_row = '', $oa_questions_col = '', $oa_section_rid = 1 )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('soc_sec', $soc_sec),
            array('oa_questions_row', $oa_questions_row),
            array('oa_questions_col', $oa_questions_col),
            array('oa_section_rid', $oa_section_rid)
        );

        return $response;
    }
}
