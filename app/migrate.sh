#!/bin/bash



rm -f propel.php
cp spropel.php propel.php

rm -f propel.php.dist
cp spropel.php.dist propel.php.dist



./propel config:convert

rm -rf models/
rm -rf Models/
rm -rf generated-sql/

./propel sql:build
./propel sql:insert

./propel model:build --verbose

cd ..
composer dump-autoload

cd app/data

php init_users.php
cd ..

rm -Rf files
mkdir -p files
chmod 0777 -R files

cp data/files/* files/.
chmod 0777 -R files
