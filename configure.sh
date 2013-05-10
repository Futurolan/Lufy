#!/bin/bash

echo "Mise a jour des permissions..."

#chown -R www-data:www-data .
#chmod -R 755 .

echo "Création du log"
mkdir -p log
#chown -R www-data:www-data log/
chmod -R 777 log/


echo "Création du cache"
mkdir -p cache
#chown -R www-data:www-data cache/
chmod -R 777 cache/


mkdir -p web/uploads/
chmod -R 777 web/uploads/


php symfony cc

echo "OK"
