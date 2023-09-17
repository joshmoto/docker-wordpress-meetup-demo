<?php
/**
 * @author      Josh Cranwell <https://github.com/joshmoto>
 *
 * @noinspection PhpUndefinedConstantInspection
 */

/**
 * @param ...$args
 * @return void
 */
function dd(...$args): void
{
    dump(...$args);
    exit;
}

/**
 * @param ...$args
 * @return void
 */
function dump(...$args): void
{
    foreach ($args as $dump) {
        echo '<pre class="dd">' . print_r($dump, true) . '</pre>';
    }
}

/**
 * @param ...$args
 * @return void
 */
function v_dd(...$args): void
{
    v_dump(...$args);
    exit;
}

/**
 * @param ...$args
 * @return void
 */
function v_dump(...$args): void
{
    foreach ($args as $dump) {
        echo '<pre class="dd">';
        var_dump($dump);
        echo '</pre>';
    }
}