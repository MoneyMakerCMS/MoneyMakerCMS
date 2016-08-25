<?php

return [
    'resource_nouns' => ['view', 'create', 'update', 'delete', ],
    'entities' => [App\Models\Access\User::class, ],
    'roles' => ['super admin', 'admin', 'user', ],
];
