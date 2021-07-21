<?php

/*
 * This file is part of bhittani/kk-star-ratings.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use function Bhittani\StarRating\functions\autoload;

if (! defined('KK_STAR_RATINGS')) {
    http_response_code(404);
    exit();
}

if (! function_exists('Bhittani\StarRating\functions\autoload')) {
    require __DIR__.'/functions/autoload.php';
}

$file = KK_STAR_RATINGS;
$path = dirname($file).'/';
$src = $path.'src/';
$ns = 'Bhittani\StarRating\\';

return [
    // Manifest
    'url' => plugin_dir_url($file),
    'path' => plugin_dir_path($file),
    'signature' => plugin_basename($file),
] + get_file_data($file, [
    // Metadata
    'author' => 'Author',
    'author_url' => 'Author URI',
    'version' => 'Version',
    'name' => 'Plugin Name',
    'slug' => 'Plugin Slug',
    'nick' => 'Plugin Nick',
]) + [
    // Source
    'core' => autoload($ns.'core', $src.'core'),
    'actions' => autoload($ns.'actions', $src.'actions'),
    'filters' => autoload($ns.'filters', $src.'filters'),
    'functions' => autoload($ns.'functions', $src.'functions'),
] + [
    // Data
    'views' => $path.'views/',
    'post_meta' => [
        'count_*' => 0,
        'fingerprint_*[]' => '',
        'ratings_*' => 0.0,
        'status_*' => '',
    ],
    'options' => [
        // General
        'enable' => true,
        'exclude_categories' => [],
        'exclude_locations' => ['archives', 'home'],
        // 'manual_control' => [],
        'strategies' => ['archives', 'guests'],
        // Appearance
        'gap' => 5,
        'greet' => 'Rate this {type}',
        'legend' => '{score}/{best} - ({count} {votes})',
        'position' => 'top-left',
        'size' => 24,
        'stars' => 5,
        // Rich snippets
        'grs' => true,
        'sd' => '
{
    "@context": "https://schema.org/",
    "@type": "CreativeWorkSeries",
    "name": "{title}",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{score}",
        "bestRating": "{best}",
        "ratingCount": "{count}"
    }
}
        ',
    ],
];
