#!/bin/bash

#mysql --user="root" --database="inclass01" --password="123" < "data/db_encoding.sql"
#mysql --user="root" --database="inclass01" --password="123" < "data/db_schema.sql"

rm -rf models/
rm -rf Models/
./propel reverse --verbose 
mv -f generated-reversed-database/schema.xml config/schema.xml 
./propel model:build --verbose 
cd .. 
composer dump-autoload 
cd app