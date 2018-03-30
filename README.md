# Overview

SpikeMVC is a minimalistic MVC framework which enables you to develop lightweight web applications with less effort. The framework allows the developer to handle url routes by creating controllers in the web application. Each controller supports HTTP methods such as GET, POST, PUT and DELETE.

SpikeMVC is based on the templating engine [Mustache](https://mustache.github.io/). In the future releases it is planned to add support to other templating engines such as Handlebars, HAML, etc...



## Creating a Hello World Web Application

SpikeMVC web application handles HTTP requests using controllers. Controllers can be created under the sub folder "pages" in the root folder of your web application.

The root folder should include two main files to handle all the incoming HTTP requests which are index.php, and .htaccess. the .htaccess file is configured to redirect all the HTTP requests to index.php. 

index.php file should consist of the following code;

```php 
<?php
    require_once ("./core/spikemvc.php");
    SpikeMVC::handle();
?>
```

.htaccess file should consist of the following code;

```hmtl 
<?php
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
?>
```

Each controller and a view in SpikeMVC can be created in a subfolder under the root folder "pages" (i.e. to handle the route http://localhost/test, the sub folder "test" should be created under the folder "pages"). The subfolder should consist of a file known as controller.php which consist of the logic of the controller, and a file known as view.html which consist of the layout of the particular controller.

In controller.php whatever the data that should be bound to the view can be set to the variable $this->dataBag.

```php 
<?php

class Controller extends SpikeController {
        
    public function get($request){
        $this->dataBag->name = "supun";
        return $this->view();
    }
    
}

return new Controller();
?>
```

view.html should include the variables that are available in the data bag.

view.html should consist 
```html
<h1>Hello {{name}}</h1>
```


## Configuring the environment for SpikeMVC

### Apache running in Linux/CentOS

First enable the rewrite module for apache

```shell
a2enmod rewrite
```

in your apache configuration (i.e. /etc/apache2/sites-enabled/000-default.conf) configure your root folder (or any other folder you prefer to apply config overriding) by setting these options.

```html
<Directory /var/www/>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride all
    Order allow,deny
    allow from all
</Directory>
```

finally restart the apache server

```shell
sudo service apache2 restart
```

make sure you have included the file '.htaccess' inside the folder where you have your web application.
