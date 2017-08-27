#!/bin/bash

rm -rf models/
rm -rf Models/
./propel reverse --verbose
mv -f generated-reversed-database/schema.xml config/schema.xml
./propel model:build --verbose
cd ..
composer dump-autoload
cd app