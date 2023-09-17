<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 * @package     WordPress
 * @theme       Docker WordPress
 */

// require our includes
require __DIR__ . '/inc/env.php';

// require our development includes
if(is('local','staging'))
    require __DIR__ . '/inc/dev.php';

/**
 * if you are using composer require autoload file here
 * @link https://brew.sh/
 * @link https://getcomposer.org/
 * @link https://packagist.org/
*/
//require __DIR__ . '/vendor/autoload.php';

// require our class libs
if(is('local'))
    require_once(__DIR__ . '/lib/Mail.lib.php');