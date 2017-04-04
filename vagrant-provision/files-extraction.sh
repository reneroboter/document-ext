#!/bin/bash
echo "Processing additional archives inside /vagrant/files"
uploads=/vagrant/files/uploads.tar.gz
fileadmin=/vagrant/files/fileadmin.tar.gz

if [ -e "$uploads" ]; then
	echo "Uploads tape archive found. Extracting..."
	cd /var/www/docroot && tar xfz $uploads
else
	echo "Uploads tape archive not found. Now looking for fileadmin.tar.gz..."
fi

if [ -e "$fileadmin" ]; then
        echo "Fileadmin tape archive found. Extracting..."
        cd /var/www/docroot && tar xfz $fileadmin
else
	echo "Fileadmin archive not found. Continuing with provisioning..."
fi
