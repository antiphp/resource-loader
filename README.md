Resource Loader
===============

This one is a Zend Framework (2) View Helper to load CSS and JavaScript resources with a special focus on dependencies.

What's done
-----------
 * The resource loader registers the requested CSS and JavaScript resources to your ZF head*() view helpers
   and resolves the resource dependencies correctly
   
   F.e. if you're using Bootstrap, then jQuery is a required resource of Bootstrap. So you have to define two resources, but you only have to load - and think about - the Bootstrap resource, because you already configured the dependency (Bootstrap requires jQuery) in your configurastion.

What's NOT done
---------------
 * The package does define any dependency, you need to define all the resource dependencies yourself.
 * The package does not download (server-side) any of your defined or requested libraries


Configuration
-------------

Here's a module configuration example. First of all we need to register the View Helper in the view helper service configuration.

```php
return array(
    'view_helpers' => array(
        'factories' => array(
            'resource' => 'AntiPhp\ResourceLoader\View\Helper\ResourceLoaderServiceFactory'
        )
    )
);
```

In the same configruation file we need to define our resource configuration like this:
```php
return aray(
    'resource_loader' => array(
        'resources' => array(
            'jquery' => array(
                'js' => 'vendor/jquery/jquery.min.js'
            ),
            'bootstrap' => array(
                'js' => 'vendor/bootstrap/js/bootstrap.min.js',
                'css' => 'vendor/bootstrap/css/bootstrap.min.css',
                'requires' => 'jquery'
            ),
            'bootstrap.themed' => array(
                'css' => 'vendor/bootstrap/css/bootstrap-theme.min.css',
                'requires' => 'boostrap'
            ),
            'yaml' => array(
                'css' => array(
                    'vendor/yaml/css/flexible-columns.css',
                    array('vendor/yaml/yaml/core/iehacks.css', 'lte IE 7')
                ),
                'requires' => 'html5shiv'
            ),
            'my_layout_1' => array(
                'requires' => array(
                    'bootstrap.themed',
                    'font-awesome'
                )
            ),
            'my_layout_2' => array(
                'requires' => 'yaml'
            ),
            // html5shiv, font-awesome, data-tables, ...
        )
    )
);
```


Usage
-----

Now that the resource loader knows all UI resources, we can use them within our layout based on Bootstrap:
```php
$this->resource('my_layout_1');
// refers to configuration key resource_loader/resources/my_layout_1
?>
<html>
    <head>
<?php
$headLink = $this->headLink();
echo $headLink->toString(8), PHP_EOL;

$headScript = $this->headScript();
echo $headScript->toString(8), PHP_EOL;
?>

    </head>
    <!-- .. -->
</html>
```


Or maybe we prefer YAML over Bootstrap:
```php
$this->resource('my_layout_2');
// refers to configuration key resource_loader/resources/my_layout_2
?>
<html>
    <head>
<?php
$headLink = $this->headLink();
echo $headLink->toString(8), PHP_EOL;

$headScript = $this->headScript();
echo $headScript->toString(8), PHP_EOL;
?>

    </head>
    <!-- .. -->
</html>
```


Or within a view script we'd like to use jQuery DataTables:
```php
$this->resource('data-table');
?>
<table class="data-table">
<!-- .. -->
</table>
```

The resource loader assures that only the required resources are loaded and that you only have to think once about dependencies.
