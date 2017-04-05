#!/bin/bash
file=/var/www/docroot/.htaccess
dummy=/var/www/docroot/_.htaccess
if [ ! -e "$file" ] && [ -e "$dummy" ]; then
	echo "Adding .htaccess file"
	cp $dummy $file
else
	echo ".htacces was not imported. Either there already was one or no template was found. Continuing..."
fi
