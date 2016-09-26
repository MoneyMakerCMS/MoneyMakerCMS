<?php

return [

    /*
     * Default path for layouts
     */
    'layouts' => [
        'path' => base_path('resources/views/frontend/layouts'),
        'name' => 'frontend.layouts.',
    ],

    /*
     * Default path for frontend pages
     */
    'pages' => [
        'path' => base_path('resources/views/frontend/pages'),
        'name' => 'frontend.pages',
    ],

    /*
     * Default middleware you can apply to a page
     */
    'middleware' => [
        ['name' => 'Web (default)', 'value' => 'web'],
        ['name' => 'Logged in', 'value' => 'auth'],
        ['name' => 'View Admin', 'value' => 'access.routeNeedsPermission:view-backend'],
    ],
];
