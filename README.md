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
Now you can install wordpress plugins, just run `php composer.phar require wpackagist-plugin/{the-plugin-name}`.
