<?php

return [
    'route' => [
        'uri' => '/menu-graphql',
        'name' => 'graphql',
        'middleware' => [
            Nuwave\Lighthouse\Http\Middleware\AcceptJson::class,
            Nuwave\Lighthouse\Http\Middleware\AttemptAuthentication::class,
        ],
    ],
    'guards' => null,
    'schema_path' => base_path('graphql/schema.graphql'),
    'schema_cache' => [
        'enable' => env('LIGHTHOUSE_SCHEMA_CACHE_ENABLE', env('APP_ENV') !== 'local'),
        'path' => env('LIGHTHOUSE_SCHEMA_CACHE_PATH', base_path('bootstrap/cache/lighthouse-schema.php')),
    ],
    'query_cache' => [
        'enable' => env('LIGHTHOUSE_QUERY_CACHE_ENABLE', true),
        'store' => env('LIGHTHOUSE_QUERY_CACHE_STORE', null),
        'ttl' => env('LIGHTHOUSE_QUERY_CACHE_TTL', 24 * 60 * 60),
    ],
    'validation_cache' => [
        'enable' => env('LIGHTHOUSE_VALIDATION_CACHE_ENABLE', false),
        'store' => env('LIGHTHOUSE_VALIDATION_CACHE_STORE', null),
        'ttl' => env('LIGHTHOUSE_VALIDATION_CACHE_TTL', 24 * 60 * 60),
    ],
    'namespaces' => [
        'queries' => 'App\\GraphQL\\Queries',
        'mutations' => 'App\\GraphQL\\Mutations',
        'subscriptions' => 'App\\GraphQL\\Subscriptions',
        'types' => 'App\\GraphQL\\Types',
        'interfaces' => 'App\\GraphQL\\Interfaces',
        'unions' => 'App\\GraphQL\\Unions',
        'scalars' => 'App\\GraphQL\\Scalars',
        'directives' => 'App\\GraphQL\\Directives',
        'validators' => 'App\\GraphQL\\Validators',
    ],
    'debug' => env('LIGHTHOUSE_DEBUG', 1),
    'subscriptions' => [
        'queue_broadcasts' => env('LIGHTHOUSE_QUEUE_BROADCASTS', true),
        'broadcasts_queue_name' => env('LIGHTHOUSE_BROADCASTS_QUEUE_NAME', null),
        'storage' => env('LIGHTHOUSE_SUBSCRIPTION_STORAGE', 'redis'),
    ],
];
