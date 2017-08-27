#!/bin/bash

#mysql --user="root" --password="123" < "data/db_encoding.sql"

#mysql --user="root" --password="123" < "data/db_schema.sql"


#mysql --user="root" --password="mysql2017" < "data/db_encoding.sql"

#mysql --user="root" --password="mysql2017" < "data/db_schema.sql"


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