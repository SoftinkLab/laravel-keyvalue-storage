<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Storage Type
    |--------------------------------------------------------------------------
    |
    | You can define the storage mechanism for your key values. We support
    | database and json file storage.
    |
    | Supported: "database", "file"
    |
    */

    'method' => 'database',

    /*
    |--------------------------------------------------------------------------
    | Storage Driver
    |--------------------------------------------------------------------------
    |
    | Specify the filesystem driver for your key file storage in "file" mode.
    | You need to configure your storage configuration before use.
    |
    | Supported: "local", "public", "s3"
    | Refer "config/filesystem.php" for more more file systems.
    |
    */

    'disk' => 'local',

    /*
    |--------------------------------------------------------------------------
    | File Path
    |--------------------------------------------------------------------------
    |
    | If you select file storage, you can specify a path to store your file.
    | Leading slash is required. Folder should be in "storage/app/" folder.
    |
    | Ex: "kvstorage/" gives this path -> "storage/app/kvstorage/"
    |
    */

    'path' => 'kvstorage/',
];
