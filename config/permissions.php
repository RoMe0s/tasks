<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 09.05.17
 * Time: 22:27
 */
return [
    'users' => [
        'write',
        'read',
        'destroy'
    ],
    'project' => [
        'write',
        'read',
        'users'
    ]
];