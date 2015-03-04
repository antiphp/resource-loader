Resource Loader
===============

This one is a Zend Framework (2) View Helper to load UI resources and their dependencies.
You need to define the dependencies yourself within the configuration. 

Add the resources and their dependencies to your module configuration:
```php
return array(
    'view_helpers' => array(
        'factories' => array(
            'resource_loader' => 'AntiPhp\ResourceLoader\View\Helper\ResourceLoaderServiceFactory'
        )
    ),
    // ..
    'resource_loader' => array(
        'class' => 'AntiPhp\ResourceLoader\View\Helper\ResourceLoader',
        'resources' => array(
            'jquery' => array(
                'js' => 'vendor/jquery/jquery.min.js'
            ),
            'bootstrap' => array(
                'js' => 'vendor/bootstrap/js/bootstrap.min.js',
                'css' => 'vendor/bootstrap/css/bootstrap.min.css',
                'requires' => 'jquery'
            ),
            'bootstrap-themed' => array(
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
            'html5shiv' => array(
                'js' => array(
                    array('vendor/html5shiv/html5shiv.js', 'lte IE 9')
                )
            ),
            'my_layout_1' => array(
                'requires' => array(
                    'bootstrap-themed',
                    'jquery'
                )
            ),
            'my_layout_2' => array(
                'requires' => 'yaml'
            )
        )
    )
);
```

Then use the resource loader like this, f.e. in your `layout/my_layout_1`:
```php
$this->resource('my_layout_1');
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
</html>```

Or in your `layout/my_layout_2`:
```php
$this->resource('my_layout_2');
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
</html>```

Or within a view script:
```php
$this->resource('data-tables', array('selector' => 'table.data-table'));
?>
<table class="data-table">
<!-- .. -->
</table>```

The resource loader assures that only the required resources are loaded.