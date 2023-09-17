<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 * @package     WordPress
 * @theme       Vite WordPress
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
require __DIR__ . '/vendor/autoload.php';

// require our class libs
require_once(__DIR__ . '/lib/Vite.lib.php');
require_once(__DIR__ . '/lib/Mail.lib.php');
require_once(__DIR__ . '/lib/Theme.lib.php');

// require our login class libs
if (is_login())
    require_once(__DIR__ . '/lib/Login.lib.php');

// require our admin class libs
if (is_admin())
    require_once(__DIR__ . '/lib/Admin.lib.php');