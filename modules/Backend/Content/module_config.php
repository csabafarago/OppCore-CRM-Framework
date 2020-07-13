<?php

$router_lang = [
    'contents' => [
        'hu' => 'tartalmak',
        'en' => 'contents',
    ],
];

$module_config = [
    'routes' => [
        'name' => 'list_contents',
        'url' => [
            'hu' => 'tartalomkezelo',
            'en' => 'contentmanager',
        ],
        'module' => 'Content', 'controller' => 'Content', 'action' => 'list', 'view' => 'list',
        'childrens' => [
            'create_content' => [
                'name' => 'create_content',
                'url' => [
                    'hu' => 'letrehozas',
                    'en' => 'create',
                ],
                'module' => 'Content', 'controller' => 'Content', 'action' => 'add', 'view' => 'add',
                'childrens' => []
            ],
            'edit_content' => [
                'name' => 'edit_content',
                'url' => [
                    'hu' => 'szerkesztes',
                    'en' => 'edit',
                ],
                'module' => 'Content', 'controller' => 'Content', 'action' => 'list', 'view' => 'list',
                'childrens' => [
                    'edit_content_id' => [
                        'name' => 'content_id',
                        'url' => '/[0-9]/',
                        'module' => 'Content', 'controller' => 'Content', 'action' => 'edit', 'view' => 'add',
                        'childrens' => []
                    ],
                ]
            ],
            'remove_content' => [
                'name' => 'remove_content',
                'url' => [
                    'hu' => 'torles',
                    'en' => 'delete',
                ],
                'module' => 'Content', 'controller' => 'Content', 'action' => 'list', 'view' => 'list',
                'childrens' => [
                     'content_id' => [
                        'name' => 'content_id',
                        'url' =>  '/[0-9]/',
                        'module' => 'Content', 'controller' => 'Content', 'action' => 'remove', 'view' => '',
                        'childrens' => []
                    ],
                ]
            ],
            'categories' => [
                'name' => 'categories',
                'url' => [
                    'hu' => 'kategoriak',
                    'en' => 'categories',
                ],
                'module' => 'Content', 'controller' => 'Category', 'action' => 'list', 'view' => 'list',
                'childrens' => [
                    'create_category' => [
                        'name' => 'create_category',
                        'url' => [
                            'hu' => 'letrehozas',
                            'en' => 'create',
                        ],
                        'module' => 'Content', 'controller' => 'Category', 'action' => 'add', 'view' => 'add',
                        'childrens' => []
                    ],
                    'edit_category' => [
                        'name' => 'edit_category',
                        'url' => [
                            'hu' => 'szerkesztes',
                            'en' => 'edit',
                        ],
                        'module' => 'Content', 'controller' => 'Category', 'action' => 'list', 'view' => 'list',
                        'childrens' => [
                            'edit_category_id' => [
                                'name' => 'edit_category_id',
                                'url' => '/[0-9]/',
                                'module' => 'Content', 'controller' => 'Category', 'action' => 'edit', 'view' => 'add',
                                'childrens' => []
                            ],
                        ]
                    ],
                    'remove_category' => [
                        'name' => 'remove_category',
                        'url' => [
                            'hu' => 'torles',
                            'en' => 'delete',
                        ],
                        'module' => 'Content', 'controller' => 'Category', 'action' => 'list', 'view' => 'list',
                        'childrens' => [
                            'remove_category_id' => [
                                'name' => 'remove_category_id',
                                'url' => '/[0-9]/',
                                'module' => 'Content', 'controller' => 'Category', 'action' => 'delete', 'view' => '',
                                'childrens' => []
                            ],
                        ]
                    ]
                ]
            ],
        ],
    ], 
];

return $module_config;
