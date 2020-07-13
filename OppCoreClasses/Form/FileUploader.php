<?php

namespace OppCoreClasses\Form;

use OppCoreClasses\Helper;

class FileUploader {

    private $uploaded_names = [];
    private $upload_config;

    public function __construct($module_name) {
        $this->upload_config = Helper::load('ModuleConfig')[$module_name]['upload_config'];
        return $this;
    }

//        'upload_config' => [
//            'film_cover_image' => [
//                'upload_path' => 'sorozatka/series', //public path-> _projects/--project_name--/uploads/--value--
//                'max_file_size' => '2097152', //2 MB
//                'allowed_mime_types' => [
//                    'image/jpeg',
//                ],
//                'image_upload' => true,
//                'image' => [
//                    'min_resulotion' => [
//                        'height' => 300,
//                        'width' => 200,
//                    ],
//                    'max_resulotion' => [
//                        'height' => 400,
//                        'width' => 800,
//                    ],
//                    'convert_resulotions' => [
//                        'small' => [
//                            'height' => 20,
//                            'width' => 20,
//                        ],
//                        'medium' => [
//                            'height' => 40,
//                            'width' => 20,
//                        ],
//                        'large' => [
//                            'height' => 70,
//                            'width' => 20,
//                        ]
//                    ]
//                ],
//            ],
//        ]

    public function validate($file_validation_array) {
        foreach ($_FILES as $name => $file) {
            if (!array_key_exists($name, $this->upload_config) || !in_array($name, $file_validation_array)) {
                return [
                    'result' => false,
                    'message' => 'File validation failed',
                ];
            }
            $validate_result = $this->validateFile($file, $name);

            if ($validate_result['result']) {
                //save file
                $this->buildDestination($this->upload_config[$name]['upload_path']);
                $new_file_name = uniqid() . '_' . $file['name'];
                move_uploaded_file($file['tmp_name'], ROOT_DIR.'/public/_projects/' . Helper::$project_name . '/uploads/' . $this->upload_config[$name]['upload_path'] . '/' .$new_file_name);
                $this->uploaded_names[$name] = $new_file_name;
            } else {
            }
        }
        if(!empty($this->uploaded_names)){
            return [
                'result' => true,
                'data' => $this->uploaded_names
            ];
        }
        return [
            'result' => false,
            'data' => 'File not found',
        ];
    }

    public function validateFile($file, $name) {
        if ($file['size'] > $this->upload_config[$name]['max_file_size']) {
            return [
                'result' => false,
                'message' => 'File size is too large',
            ];
        }
        if (!in_array($file['type'], $this->upload_config[$name]['allowed_mime_types'])) {
            return [
                'result' => false,
                'message' => 'Invalid file format',
            ];
        }
        return [
            'result' => true,
        ];
    }

    public function buildDestination($upload_path) {
        $file_path_array = explode('/', $upload_path);
        $temp_path = [];
        foreach ($file_path_array as $path) {
            $temp_path[] = $path;
            if (!file_exists(ROOT_DIR.'/public/_projects/' . Helper::$project_name . '/uploads/' . implode('/', $temp_path))) {
                mkdir(ROOT_DIR.'public/_projects/' . Helper::$project_name . '/uploads/' . implode('/', $temp_path), 0777);
            }
        }
    }

}
