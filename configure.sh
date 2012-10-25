#!/bin/bash

echo "Mise a jour des permissions..."

chown -R www-data:www-data .
chmod -R 755 .
chown -R www-data:www-data log/
chown -R www-data:www-data cache/
chmod -R 777 cache/
chmod -R 777 log/
chmod -R 777 web/uploads/
php symfony cc

echo "OK"
