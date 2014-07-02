Layout
=======

Zf2 module for set layouts

Requirements:
=============

* Zend Framework 2 latest stable version

Installation
============

* Add require ```"alt/layout": "dev-master"``` to composer.json in your project
and install.

* Add "Layout" to application config.

* Create configuration file in autoload directory in your project with content:
```php
    'module_layouts' => [
            'Application' => 'layout/application',
            'MyModule' => 'layout/mymodule'
    ]
```