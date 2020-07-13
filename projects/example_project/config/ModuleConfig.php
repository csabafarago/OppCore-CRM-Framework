<?php

return
['sorozatka' => 
    [
        'film_quality_list' => [
            '0'=> 'DVD',
            '1'=> 'Mozis',
            '2'=> 'BlueRay RIP',
        ],
        'film_type_list' => [
            '0'=> 'Magyar',
            '1'=> 'Angol',
            '2'=> 'Angol, felirattal',
        ],
        'film_storage_list' => [
            '0'=> 'a tárhely',
            '1'=> 'b tárhely',
            '2'=> 'c tárhely',
        ],
        'series_quality_list' => [
            '0'=> 'DVD',
            '1'=> 'Mozis',
            '2'=> 'BlueRay RIP',
        ],
        'series_type_list' => [
            '0'=> 'Magyar',
            '1'=> 'Angol',
            '2'=> 'Angol, felirattal',
        ],
        'series_storage_list' => [
            '0'=> 'a tárhely',
            '1'=> 'b tárhely',
            '2'=> 'c tárhely',
        ],
        'upload_config' => [
            'series_cover_image' => [
                'upload_path' => 'sorozatka/series', //public path-> _projects/--project_name--/uploads/--value--
                'max_file_size' => '2097152', //2 MB
                'allowed_mime_types' => [
                    'image/jpeg',
                ],
                'image_upload' => true,
                'image' => [
                    'min_resulotion' => [
                        'height' => 300,
                        'width' => 200,
                    ],
                    'max_resulotion' => [
                        'height' => 400,
                        'width' => 800,
                    ],
                    'convert_resulotions' => [
                        'small' => [
                            'height' => 20,
                            'width' => 20,
                        ],
                        'medium' => [
                            'height' => 40,
                            'width' => 20,
                        ],
                        'large' => [
                            'height' => 70,
                            'width' => 20,
                        ]
                    ]
                ],
            ],
            'film_cover_image' => [
                'upload_path' => 'sorozatka/film', //public path-> _projects/--project_name--/uploads/--value--
                'max_file_size' => '2097152', //2 MB
                'allowed_mime_types' => [
                    'image/jpeg',
                ],
                'image_upload' => true,
                'image' => [
                    'min_resulotion' => [
                        'height' => 300,
                        'width' => 200,
                    ],
                    'max_resulotion' => [
                        'height' => 400,
                        'width' => 800,
                    ],
                    'convert_resulotions' => [
                        'small' => [
                            'height' => 20,
                            'width' => 20,
                        ],
                        'medium' => [
                            'height' => 40,
                            'width' => 20,
                        ],
                        'large' => [
                            'height' => 70,
                            'width' => 20,
                        ]
                    ]
                ],
            ],
        ]
    ]
    
];
