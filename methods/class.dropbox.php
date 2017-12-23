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

class dropbox
{
    /**
     * app_term will setup variables for available application terms
     */
    public static function app_term( $value, $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('value_', $value), # required
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties)
        );

        return $response;
    }

    /**
     * campus will bring all the available campuses
     */
    public static function campus( $hide_excludes, $allow_blank = '', $multi_select = '', $hide = '', $value = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('value_', $value),
            array('Additional_Properties', $Additional_Properties),
            array('hide_excludes', $hide_excludes) # required
        );

        return $response;
    }

    /**
     * county will bring all the available USA counties
     */
    public static function county( $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '', $disp_only = '', $value = ''  )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('value_', $value),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties),
            array('disp_only', $disp_only)
        );

        return $response;
    }

    /**
     * countries will bring all the available countries
     */
    public static function country( $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties)
        );

        return $response;
    }

    /**
     * interest will bring all the available interest subjects??
     */
    public static function interest( $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties)
        );

        return $response;
    }

    /**
     * state will bring all the available USA states
     */
    public static function state( $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties)
        );

        return $response;
    }

    /**
     * program will bring all the available programs offered by the school
     */
    public static function program( $hide_excludes, $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties),
            array('hide_excludes', $hide_excludes) # required
        );

        return $response;
    }

    public static function degree( $allow_blank = '', $multi_select = '', $hide = '', $Additional_Properties = '' )
    {
        $response = array(
            array('sonis_ds', '#sonis.ds#'),
            array('MainDir', '#MainDir#'),
            array('allow_blank', $allow_blank),
            array('multi_select', $multi_select),
            array('hide', $hide),
            array('Additional_Properties', $Additional_Properties)
        );

        return $response;
    }
}
