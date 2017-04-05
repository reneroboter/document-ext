#!/bin/bash
echo "Dropping old database..."
mysql -u root -pspitze23 -h localhost -Bse "DROP DATABASE IF EXISTS typo3"
echo "Creating new database..."
mysql -u root -pspitze23 -h localhost -Bse "CREATE DATABASE IF NOT EXISTS typo3 CHARACTER SET utf8 COLLATE utf8_general_ci"

file=/vagrant/files/typo3.sql.gz
if [ -e "$file" ]; then
	echo "Importing MySQL database..."
	gunzip < $file | mysql -u root -pspitze23 typo3
else
	echo "Database dump not found. Continuing anyway..."
fi
