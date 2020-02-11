Post module for Evolun
=======

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist polgarz/evolun-post "@dev"
```

or add

```
"polgarz/evolun-post": "@dev"
```

to the require section of your `composer.json` file.

Migration
-----
```
php yii migrate/up --migrationPath=@vendor/polgarz/evolun-post/migrations
```

Configuration
-----

```php
'modules' => [
    'post' => [
        'class' => 'evolun\post\Module',
    ],
],
```