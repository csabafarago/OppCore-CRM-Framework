<?php

$lang = [
    'content_manager' => [
        'en' => 'Contentmanager',
        'hu' => 'Tartalomkezelő',
    ],
    'contents' => [
        'en' => 'Contents',
        'hu' => 'Tartalmak',
    ],
    'categories' => [
        'en' => 'Categories',
        'hu' => 'Kategóriák',
    ],
];
return [
    [
        'name' => $lang['content_manager'],
        'type' => '',
        'i' => 'fa fa-link',
        'url' => false,
        'link' => false,
        'childrens' => [
            [
                'name' => $lang['contents'],
                'type' => '',
                'i' => 'fa fa-link',
                'url' => 'list_contents',
                'link' => ['admin_home', 'list_contents'],
                'childrens' => []
            ],
            [
                'name' => $lang['categories'],
                'type' => '',
                'i' => 'fa fa-link',
                'url' => 'categories',
                'link' => ['admin_home', 'list_contents', 'categories'],
                'childrens' => []
            ],
        ]
    ],
];
