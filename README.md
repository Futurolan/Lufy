# Lufy

## Requirements

* Apache 2.x
* PHP >= 5.2.1
* MySQL 5.x

## Installation

* Clone this project

> git clone git://github.com/Futurolan/Lufy.git

* Check your configuration

> php check_configuration.php

* Add your databases.yml

> vi config/databases.yml

    all:
      doctrine:
        class: sfDoctrineDatabase
        param:
          dsn: 'mysql:host=localhost;dbname=your_database'
          username: your_login
          password: your_password

* Build your database

> php symfony doctrine:build --all
