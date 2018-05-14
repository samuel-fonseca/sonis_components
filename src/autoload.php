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

/**
 * autoload will load needed classes on demand
 *
 * @var $class holds name of invoked class
 */
function autoload( $class )
{
    /* available classes */
    $classes = array(
        /* user classes */
        'sonis'         => __DIR__ . '/class.sonis.php', # core class for Sonis API/SQL connection and usage

        /* static methods */
        'address'       => __DIR__ . '/methods/class.address.php', # get address info of student/applicant
        'biographic'    => __DIR__ . '/methods/class.biographic.php', # get info of student/applicant
        'dropbox'       => __DIR__ . '/methods/class.dropbox.php', # drop-downs provided by Sonis
        'education'     => __DIR__ . '/methods/class.education.php', # previous education info
        'employment'    => __DIR__ . '/methods/class.employment.php', # previous employment info
        'OAQuestions'   => __DIR__ . '/methods/class.OAQuestions.php', # OA Questions (Additional Questions)
        'pagenote'      => __DIR__ . '/methods/class.pagenote.php', # pagenote ???
        'program'       => __DIR__ . '/methods/class.program.php', # program student signs up for
        'student_app'   => __DIR__ . '/methods/class.student_app.php', # student application API
    );

    if ( !empty ( $classes[$class] ) )
    {
        require_once $classes[$class];
    }
}

// empty function to register classes
spl_autoload_register('autoload');
{}
