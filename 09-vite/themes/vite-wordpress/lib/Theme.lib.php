<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 * @package     WordPress
 * @theme       Vite WordPress
 */

class Theme {

    public function __construct()
    {

        // enqueue admin styles scripts
        add_action('wp_enqueue_scripts', [ $this, 'enqueue_styles_scripts' ], 20);

    }

    /**
     * @return void
     * @throws Exception
     */
    public function enqueue_styles_scripts(): void
    {

        // enqueue the vite hot file module
        Vite::enqueue_module();

        // register theme-style-css
        $filename = Vite::asset('resources/scss/theme.scss');

        // enqueue theme-style-css
        wp_enqueue_style('theme-style', $filename, [], null, 'screen');

        // register theme-script-js
        $filename = Vite::asset('resources/js/theme.js');

        // enqueue theme-script-js
        wp_enqueue_script('theme-script', $filename, [], null, true);

        // update html script type to module wp hack
        Vite::script_type_module('theme-script');

    }

}

new Theme();