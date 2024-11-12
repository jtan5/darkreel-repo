<?php

// There are values which change between operating systems
// It is listed in .gitignore in the root so Git doesn't 
// track changes in it.


/* 
!IMPORTANT -- ERROR REPORTING
Turn off before pushing this site to production
Turn this on to receive descriptive errors about
your PHP code. Ideally, your code is so good
it doesn't throw any errors if this is on
Please leave these here for debuggin and marking
*/
// ini_set('display_errors', 'Off');
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);


// Config variables
$site = [
    'url' => 'http://localhost:8888/darkreel-repo',
    'env' => 'unix', ## 'unix' or 'windows'
];


// MySQL Login Info
$mysql = [
    'host'  => 'localhost',
    'port'  => '3306',
    'db'    => 'darkreel_repo',
    'user'  => 'darkreel_repo',
    'pass'  => 'LdC_P0fmSubK7x82',
];

?>