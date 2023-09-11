<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 * @package     WordPress
 * @theme       Vite WordPress
 */

class Admin {

    public function __construct()
    {

        // enqueue admin styles scripts
        add_action('admin_enqueue_scripts', [ $this, 'enqueue_styles_scripts' ], 10);

    }

    /**
     * @return void
     * @throws Exception
     */
    public function enqueue_styles_scripts(): void
    {

        // enqueue the vite hot file module
        Vite::enqueue_module();

        // register admin-style-css
        $filename = Vite::asset('resources/scss/admin.scss');
        wp_register_style('admin-style', $filename,[], null, 'screen');

        // enqueue admin-style-css
        wp_enqueue_style('admin-style');

        // register admin-script-js
        $filename = Vite::asset('resources/js/admin.js');
        wp_register_script('admin-script', $filename, [], null, true);

        // enqueue admin-script-js
        wp_enqueue_script('admin-script');

        // update html script type to module wp hack
        Vite::script_type_module('admin-script');

    }

}

new Admin();