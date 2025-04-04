<?php

return [

    'default' => [
        'url' => env('WOOCOMMERCE_STORE_URL'),
        'consumer_key' => env('WOOCOMMERCE_CONSUMER_KEY'),
        'consumer_secret' => env('WOOCOMMERCE_CONSUMER_SECRET'),
        'wp_api' => true,
        'version' => 'wc/v3',
    ],

    'second_store' => [
        'url' => env('WOOCOMMERCE_SECOND_STORE_URL'),
        'consumer_key' => env('WOOCOMMERCE_SECOND_STORE_CONSUMER_KEY'),
        'consumer_secret' => env('WOOCOMMERCE_SECOND_STORE_CONSUMER_SECRET'),
        'wp_api' => true,
        'version' => 'wc/v3',
    ],

    /**
     *================================================================================
     * Store URL eg: http://example.com
     *================================================================================.
     */
    'store_url'         => env('WOOCOMMERCE_STORE_URL', 'YOUR_STORE_URL'),

    /**
     *================================================================================
     * Consumer Key
     *================================================================================.
     */
    'consumer_key'      => env('WOOCOMMERCE_CONSUMER_KEY', 'YOUR_CONSUMER_KEY'),

    /**
     * Consumer Secret.
     */
    'consumer_secret'   => env('WOOCOMMERCE_CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET'),

    /**
     *================================================================================
     * SSL support
     *================================================================================.
     */
    'verify_ssl'        => env('WOOCOMMERCE_VERIFY_SSL', false),

    /**
     *================================================================================
     * Woocommerce API version
     *================================================================================.
     */
    'api_version'       => env('WOOCOMMERCE_API_VERSION', 'v3'),

    /**
     *================================================================================
     * Enable WP API Integration
     *================================================================================.
     */
    'wp_api'            => env('WP_API_INTEGRATION', true),

    /**
     *================================================================================
     * Force Basic Authentication as query string
     *================================================================================.
     */
    'query_string_auth' => env('WOOCOMMERCE_WP_QUERY_STRING_AUTH', false),

    /**
     *================================================================================
     * Default WP timeout
     *================================================================================.
     */
    'timeout'           => env('WOOCOMMERCE_WP_TIMEOUT', 15),

    /**
     *================================================================================
     * Total results header
     * Default value X-WP-Total
     *================================================================================.
     */
    'header_total'           => env('WOOCOMMERCE_WP_HEADER_TOTAL', 'X-WP-Total'),

    /**
     *================================================================================
     * Total pages header
     * Default value X-WP-TotalPages
     *================================================================================.
     */
    'header_total_pages'           => env('WOOCOMMERCE_WP_HEADER_TOTAL_PAGES', 'X-WP-TotalPages'),
];
