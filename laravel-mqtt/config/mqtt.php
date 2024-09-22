<?php

return [
    'host'          => env('MQTT_HOST', 'localhost'),
    'port'          => env('MQTT_PORT', 1883),
    'username'      => env('MQTT_USERNAME', null),
    'password'      => env('MQTT_PASSWORD', null),
    'client_id'     => env('MQTT_CLIENT_ID', 'laravel_mqtt_client'),
    'keep_alive'    => env('MQTT_KEEP_ALIVE', 60),
    'clean_session' => env('MQTT_CLEAN_SESSION', true),
    'debug'         => env('MQTT_DEBUG', false),
];
