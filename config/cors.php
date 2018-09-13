<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];

/*
 *
curl -X POST http://localhost:8001/services/erp-ms/plugins \
    --data "name=cors"  \
--data "config.origins=http://app.bunifu.io,http://localhost:3000,http://localhost:3001,http://localhost:4000" \
--data "config.methods=GET, POST, PATCH, DELETE" \
--data "config.headers=Authorization,Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Auth-Token, client-id, client-name" \
--data "config.exposed_headers=X-Auth-Token" \
--data "config.credentials=false" \
--data "config.max_age=3600"

*/