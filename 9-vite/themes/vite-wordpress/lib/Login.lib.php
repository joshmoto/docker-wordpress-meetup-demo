<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 * @package     WordPress
 * @theme       Vite WordPress
 */

class Login {

    public function __construct()
    {

        // enqueue login styles scripts
        add_action('login_enqueue_scripts', [ $this, 'enqueue_styles_scripts' ]);

    }

    /**
     * @return void
     * @throws Exception
     */
    public function enqueue_styles_scripts(): void
    {

        // dequeue default form styles
        // wp_dequeue_style('forms');
        // wp_deregister_style('forms');

        // enqueue the vite hot file module
        Vite::enqueue_module();

        // register wp-login-css
        $filename = Vite::asset('resources/scss/login.scss');
        wp_register_style('login-style', $filename,[], false, 'screen');

        // enqueue wp-login-css
        wp_enqueue_style('login-style');

        // register wp-login-js
        $filename = Vite::asset('resources/js/login.js');
        wp_register_script('login-script', $filename, [], false, true);

        // enqueue wp-login-js
        wp_enqueue_script('login-script');

        // update html script type to module wp hack
        Vite::script_type_module('login-script');

    }

}

new Login();