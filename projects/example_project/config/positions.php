<?php
//home url must be set
return [
    [
        'params' => ['lang' => 'hu', 'url' => 'home'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ],
        'moduleSettings' => [
            'template' => 'index2.phtml'
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home'],
        'positions' => [
            'featured' => [
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'Search',
//                    'action' => 'searchForm',
//                    'view' => 'top_search',
//                    'permission' => 'default',
//                ],
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
                [
                    'module' => 'Content',
                    'controller' => 'Category',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ],
    ],
    [
        'params' => ['lang' => 'hu', 'url' => 'home/list_contents'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home/list_contents'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'hu', 'url' => 'home/error_404'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home/error_404'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'hu', 'url' => 'home/debug'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home/debug'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Content',
                    'controller' => 'Content',
                    'action' => 'index',
                    'view' => 'example_view',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
];
