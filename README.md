# OppCore-CRM-Framework

This system can run multiple websites on different domain using the same code.
The project was created for learning porpuses only some years ago. If you are coming with ZF 2 experience you will see some familiar solution in this system.

## Features:
* Using PSR autoloader and fully OOP based
* Modular system (submodules are supported)
* Multi language support (routes support multi languages by default)
* AJAX backend
* Built in form renderer and validators
* Customizable login and registration fields in config
* Mobile device detection
* Content manager module with SEF urls, WYSWYG editor (TinyMCE), direct image upload into content

## Requirements

PHP 5.6 (It works fine with 7.3)
MySQL 5.7.29 (tested)

## Getting Started

A default project config is provided as an example which can be found in the /projects folder.

Admin login url domain.xy/en-admin
Domain must be set in /projects/domain_config.php file.
```
    'opp-core.test' => [
        'environment' => 'localhost',
        'project' => 'sorozatka'
    ],
```
Import sql dump file from the example project folder than set the credentials in /projects/<project_name>/config.php

Default user:
Email/password: faragoc@example.com / nincs

In case you aren't using Vagrant here is a Virtualhost config example
```
<VirtualHost 127.0.0.1:80>
    ServerName opp-core.test
    # here you can add other domains 
    DocumentRoot /path/to/the/framework/public
    <Directory /path/to/the/framework/public>
        DirectoryIndex index.php
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Session handler usage

```
use OppCoreClasses\Session\SessionHandler;

$this->session->setSession('variable', $variable1);
$this->session->getSession('variable');
$this->session->setFlashMessage('variable2', $variable2);
$this->session->getFlashMessage('variable2');
```

### Prerequisites

The system should run on any LAMP envoirement.

### Creating new project

A step by step guide ... 

```
-- TODO --
```

## Built With

* [Admin LTE](https://adminlte.io/) - Admin template

## Contributing

I will add a guide how to create a new project shortly. 
This project is no longer maintaned. There are lot of great frameworks just pick up one which you like.

## Authors

* Csaba Farago

## License

This project is licensed under the MIT License.