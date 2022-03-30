<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Deraak-core Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Deraak-core will be accessible from. If the
    | setting is null, Deraak-core will reside under the same domain as the
    | application. Otherwise, this value will be used as the subdomain.
    |
    */

    'domain' => env('DERAAK_CORE_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Deraak-core Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Deraak-core will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => env('DERAAK_CORE_PATH', 'deraak-core'),

    /*
    |--------------------------------------------------------------------------
    | Deraak-core Admin Api middleware
    |--------------------------------------------------------------------------
    |
    | Here you can add the middlewares for public and private routes.
    | for example you can set the auth:api middleware to private routes to check
    | the user is authenticated or not
    */

    'adminApiMiddlewares' => [
        'group'  => 'web', // web or api
        'public' => [],
        'private' => []
    ],

    /*
    |--------------------------------------------------------------------------
    | Deraak-core  Api middleware
    |--------------------------------------------------------------------------
    |
    | Here you can add the middlewares for public and private routes.
    | for example you can set the auth:api middleware to private routes to check
    | the user is authenticated or not
    */

    'apiMiddlewares' => [
        'group' => 'api',  // web or api
        'public' => [],
        'private' => []
    ],

    /*
    |--------------------------------------------------------------------------
    | Deraak-core  views config
    |--------------------------------------------------------------------------
    |
    | for showing the views you can determine these configs or you can publish
    | the package views
    |
    */

    'views' => [
        'admin' => [
            'extends'           => 'deraak-core::admin.master',
            'content-section'   => 'content',
            'title-section'     => 'title',
            'scripts-stack'     => 'scripts',
            'styles-stack'      => 'styles'
        ],
    ],

];
