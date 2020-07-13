<?php

return [
    'routes' => [
        [
            'list_contents' => [
                'name' => 'list_contents',
                'url' => [
                    'hu' => 'hu',
                    'en' => 'en',
                ],
                'module' => 'Content', 'controller' => 'Content', 'action' => 'contents', 'view' => 'contents',
                'childrens' => [
                    'content_sef'=> [
                        'name' => 'content_sef',
                        'url' => '/^[0-9a-zA-Z\-]{1,120}$/',
                        'module' => 'Content', 'controller' => 'Content', 'action' => 'showcontent', 'view' => 'showcontent',
                        'childrens' => []
                    ]
                ]       
            ],
        ]
    ],
];