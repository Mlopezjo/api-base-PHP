# API Base PHP

It's a PHP MVC Framework to build web APIs faster.

It's the sum of my PHP language learning, it grows with each question I ask myself:

  It's start with the first one :
  
    How to make a PHP router ?
My journey has only just begun :)


# The next implementations :
- Database migration ans seed
- Scheduled tasks
- Automatic generation of routes according to the methods present in the controllers
- generation of accessible views to manage API access and consumption
- creation of a CLI

# Get Started :

> Get the project

$ git clone https://github.com/Mlopezjo/api-base-PHP.git abp

$ cd abp

$ composer install

> Add a VirtualHost

<pre>
<VirtualHost *:80> 
    DocumentRoot "var/www/abp"
    ServerName localhost
    ServerAlias *.localhost
    <Directory "var/www/abp">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
</pre>


