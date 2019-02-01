#!/bin/sh

/usr/bin/mysqld_safe > /dev/null 2>&1 &

mysqladmin --silent --wait=30 ping
mysql -uroot -e "CREATE USER 'erik'@'%' IDENTIFIED BY 'skipjack'"
mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO 'erik'@'%' WITH GRANT OPTION"
mysql -uroot -e "FLUSH PRIVILEGES"
mysql -uroot -e "CREATE SCHEMA database_1"
mysql -uroot -e "CREATE SCHEMA database_1_test"
mysql -uroot -e "USE database_1_test; SOURCE testData.sql;"

echo "=> Done!"

echo "========================================================================"
echo "You can now connect to this MariaDB Server using:"
echo ""
echo "    mysql -uerik -pskipjack -h<host> -P<port>"
echo ""
echo "Please remember to change the above password as soon as possible!"
echo "MariaDB user 'root' has no password but only allows local connections"
echo "========================================================================"

mysqladmin -uroot shutdown