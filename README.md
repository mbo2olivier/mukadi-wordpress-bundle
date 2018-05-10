MukadiWordpressBundle
====================

This is a fork of [EkinoWordpressbundle](https://github.com/ekino/EkinoWordpressBundle), this bundle adapt EkinoWordpressBundle to symfony 4 new architecture and features. Some features has been removed (such as automatic symfony authentication when authenticated in Wordpress...) and will be reintegrated as separated bundle to install if needed.

Here are some retained features:

* Use custom Symfony services into Wordpress (note: only public services),
* Use Symfony to manipulate Wordpress database,
* Create custom Symfony routes out of Wordpress,
* Dispatch Event from Wordpress into Symfony *(require mukadi-symfony-bridge Wordpress plugin)

---

## Installation

Before install the bundle, edit your composer.json file and specify the following options:

```yml
"extra": {
    ...
    "symfony": {
        ...
        "allow-contrib": "true"
    }
    ...
    "installer-paths": {
        "wp/mu-plugins/{$name}": ["type:wordpress-muplugin"],
        "wp/plugins/{$name}": ["type:wordpress-plugin"],
        "wp/themes/{$name}": ["type:wordpress-theme"]
    },
    "wordpress-install-dir": "public"
},
```

Run `php composer.phar require mukadi/wordpress-bundle` and let Symfony Flex configure the bundle.

** Note: If you make modifications on your public/index.php file, you must keep a backup copy before installing the bundle.

## Add Wordpress routing into symfony

Add the WordpressBundle routing file in your `config/routes.yaml`, after your custom routes to catch all Wordpress routes:

```yml
...
mukadi_wordpress:
    resource: "@MukadiWordpressBundle/Resources/config/routing.xml"
```


## Install Wordpress Plugins via Composer

Edit your composer.json file to add a custom repository:

```yml
...
"repositories": [
    {
        "type": "composer",
        "url": "https://wpackagist.org"
    }
]
```
Now you can install wordpress plugins, just run `php composer.phar require wpackagist-plugin/<the-plugin-name>`.

## Manipulate Wordpress database in Symfony

You can call Wordpress table managers in Symfony by calling the following services:

*Service identifier* | *Type*
--- | ---
mukadi_wordpress.manager.comment | Wordpress comment manager
mukadi_wordpress.manager.comment_meta | Wordpress comment metas manager
mukadi_wordpress.manager.link | Wordpress link manager
mukadi_wordpress.manager.option | Wordpress option manager
mukadi_wordpress.manager.post | Wordpress post manager
mukadi_wordpress.manager.post_meta | Wordpress post metas manager
mukadi_wordpress.manager.term | Wordpress term manager
mukadi_wordpress.manager.term_relationships | Wordpress term relationships manager
mukadi_wordpress.manager.term_taxonomy | Wordpress taxonomy manager
mukadi_wordpress.manager.user | Wordpress user manager
mukadi_wordpress.manager.user_meta | Wordpress user metas manager

All of this services extends the `Mukadi\Doctrine\CRUD\CRUD` class, so see the [documentation](https://github.com/mbo2olivier/mukadi-doctrine-crud) to know how to deal with it.