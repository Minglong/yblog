#!/bin/bash
if [ -n "$1" ];then   #双引号不能省
	chmod 744 . 
	chmod 744 ./protected/runtime
	chmod 744 ./assets
	echo  enable 
else
	chmod 544 .
	chmod 544 ./protected/runtime
	chmod 544 ./assets
	echo  disable 
fi
