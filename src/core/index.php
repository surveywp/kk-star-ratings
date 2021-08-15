<?php

/*
 * This file is part of bhittani/kk-star-ratings.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

if (! defined('KK_STAR_RATINGS')) {
    http_response_code(404);
    exit();
}

// TODO: Use 'core' key. e.g. ['core' => ...].
kksr(require __DIR__.'/config.php');

foreach ([
    'hooks.php',
    'hydrate.php',
] as $filename) {
    $filepath = __DIR__.'/'.ltrim($filename, '\/');
    require_once $filepath;
}
