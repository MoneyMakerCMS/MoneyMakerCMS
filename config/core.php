<?php

use App\Models\Content\Content;

return [
    /*
    |--------------------------------------------------------------------------
    | Admin URI
    |--------------------------------------------------------------------------
    |
    | The Admin url that will be used to configure backend urls
    |
    */

   'admin_uri' => 'admin',

   /*
    |--------------------------------------------------------------------------
    | Nouns
    |--------------------------------------------------------------------------
    |
    | The resouce nouns that will be used to create abilites
    | as mapped in Laravel AuthorizeRequests class
    | https://github.com/laravel/framework/blob/d2a41e4/src/Illuminate/Foundation/Auth/Access/AuthorizesRequests.php#L104-L114
    |
    */

    'resource_nouns' => ['view', 'create', 'update', 'delete'],


    /*
    |--------------------------------------------------------------------------
    | Entities
    |--------------------------------------------------------------------------
    |
    | The application models that you want to create ablities for.
    | All models listed in the array will have resouce ablites created
    |
    */

    'entities'       => [
        App\Models\Access\User::class,
        App\Models\Content\Content::class,
        // 'Silber\Bouncer\Database\Role',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default application roles.
    |--------------------------------------------------------------------------
    |
    | These are the default application roles that will be created.
    | Super Admin role will have 'god mode' access and will be
    | bypass all checks, Admin will by default be given all
    | permissions when seeded
    |
    */

    'roles'          => ['super admin', 'admin', 'user'],
];
