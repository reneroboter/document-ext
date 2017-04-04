#!/bin/bash
echo "max_input_vars=1500" >> /etc/php/7.0/apache2/conf.d/99-custom.ini
echo -e "; apache crash workaround\npcre.jit=0" >> /etc/php/7.0/apache2/conf.d/99-custom.ini
service apache2 restart