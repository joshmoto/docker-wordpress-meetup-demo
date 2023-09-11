<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 *
 * @noinspection PhpUndefinedConstantInspection
 */

/**
 * @return string
 */
function environment(): string
{
    // default to production env if no environment constant is not defined
    return defined('ENVIRONMENT') ? ENVIRONMENT : 'production';
}

/**
 * @param ...$environments
 * @return true|void
 */
function is(...$environments)
{
    if (in_array(environment(),$environments,true)) {
        return true;
    }
}

// increase the upload max size on server environments
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

// acf json directory filter
add_filter('acf/json_directory', function ($path) {
    return get_template_directory() . '/config/acf-json';
});

// acf save json filter
add_filter('acf/settings/save_json', function ($path) {
    return apply_filters('acf/json_directory', NULL);
});

// acf load json filter
add_filter('acf/settings/load_json', function ($paths) {
    return [apply_filters('acf/json_directory', NULL)];
});
