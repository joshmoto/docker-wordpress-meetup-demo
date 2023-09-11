<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 * @package     WordPress
 * @theme       Vite WordPress
 *
 * @noinspection PhpUndefinedConstantInspection
 */

class Mail {

    public function __construct()
    {

        // wp mail failed action
        add_action('wp_mail_failed', [ $this, 'action_wp_mail_failed_log' ], 10, 1);

        // configure phpmailer to send through smtp
        add_action('phpmailer_init', [ $this, 'action_phpmailer_init' ]);

        // force the from email address
        add_filter('wp_mail_from', [ $this, 'filter_wp_mail_from' ]);

    }

    /**
     * @param $phpmailer
     * @return void
     */
    private function action_phpmailer_init($phpmailer): void
    {

        $phpmailer->isSMTP();
        // host details
        $phpmailer->SMTPAuth = WORDPRESS_SMTP_AUTH;
        $phpmailer->SMTPSecure = WORDPRESS_SMTP_SECURE;
        $phpmailer->SMTPAutoTLS = false;
        $phpmailer->Host = WORDPRESS_SMTP_HOST;
        $phpmailer->Port = WORDPRESS_SMTP_PORT;
        // login details
        $phpmailer->Username = WORDPRESS_SMTP_USERNAME;
        $phpmailer->Password = WORDPRESS_SMTP_PASSWORD;
        // from details
        $phpmailer->From = WORDPRESS_SMTP_FROM;
        $phpmailer->FromName = WORDPRESS_SMTP_FROM_NAME;

    }

    /**
     * @return string
     */
    private function filter_wp_mail_from(): string
    {

        // return from email constant
        return WORDPRESS_SMTP_FROM;

    }

    /**
     * @param $wp_error
     * @return void
     */
    private function action_wp_mail_failed_log($wp_error): void
    {

        // get the log file path for mail logs
        $log_file = WP_CONTENT_DIR . '/logs/mail.log';

        // set the error message
        $error_message = '';

        // check if the error has a stack trace
        if ($wp_error instanceof WP_Error && isset($wp_error->error_data['wp_error_data'])) {
            $error_message .= $wp_error->get_error_message() . "\n";
            $error_message .= "Stack trace:\n";
            $error_message .= $wp_error->error_data['wp_error_data'] . "\n";
        } else {
            $error_message = $wp_error->get_error_message() . "\n";
        }

        // format the error message with timestamp and error type
        $formatted_error_message = sprintf(
            "[%s] WP Mail Error: %s",
            date('d-M-Y H:i:s T'),
            $error_message
        );

        // append the error message to the log file
        file_put_contents($log_file, $formatted_error_message, FILE_APPEND);

    }

}

new Mail();