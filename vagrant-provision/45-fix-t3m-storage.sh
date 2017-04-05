#!/bin/bash
mysql -uroot -hlocalhost -pspitze23 typo3 -e "DELETE FROM sys_file_storage WHERE uid = 2";
