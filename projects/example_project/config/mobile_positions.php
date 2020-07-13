<?php
//home url must be set
return [
    [
        'params' => ['lang' => 'hu', 'url' => 'home'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'view' => 'style1',
                ],
            ],
//            'banner' => [
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'Banner',
//                    'action' => 'showBanner',
//                    'style' => 'style1',
//                    'permission' => 'default',
//                ],
//            ],
//            'featured' => [
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'FeaturedContent',
//                    'action' => 'mostWatchedVideos',
//                    'style' => 'style1',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'FeaturedContent',
//                    'action' => 'newestVideos',
//                    'style' => 'style1',
//                    'permission' => 'default',
//                ],
//            ],
        ],
        'moduleSettings' => [
            'template' => 'index2.phtml'
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
                    'permission' => 'default',
                ],
            ],
//            'banner' => [
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'Banner',
//                    'action' => 'showBanner',
//                    'style' => 'style1',
//                    'permission' => 'default',
//                ],
//            ],
//            'featured' => [
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'FeaturedContent',
//                    'action' => 'mostWatchedVideos',
//                    'style' => 'style1',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'Sorozatka',
//                    'controller' => 'FeaturedContent',
//                    'action' => 'newestVideos',
//                    'style' => 'style1',
//                    'permission' => 'default',
//                ],
//            ],
        ],
    ],
    [
        'params' => ['lang' => 'hu', 'url' => 'home/list_contents'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
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
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
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
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
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
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
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
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
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
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'hu', 'url' => 'home/sorozatka_list_films'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home/sorozatka_list_films'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'hu', 'url' => 'home/sorozatka_list_series'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => 'home/sorozatka_list_series'],
        'positions' => [
            'navigation' => [
                [
                    'module' => 'Sorozatka',
                    'controller' => 'Menu',
                    'action' => 'menu',
                    'style' => 'style1',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
];
