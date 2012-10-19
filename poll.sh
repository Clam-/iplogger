#!/bin/sh
#use CURL or WGET here
cmd="CURL"
url="http://domain/path/ip.php"

#set this to proper directory if running from cron
# or set correct cwd in cron
logdir=`pwd`

# http://stackoverflow.com/a/3742990
if [ "$cmd" = "CURL" ] 
then
	cmd="wget URL -q -O -"
elif [ "$cmd" = "WGET" ] 
then
	cmd="curl -f -L URL"
fi
cmd=`echo $cmd | sed -e "s!URL!${url}!g"`
content=$($cmd)
if [ "$?" -ne 0 ]
then
	#>> "$logdir/poller.log"
	echo `date -u +"%Y%m%d-%H:%M:%S Error with GET"` 
else
	if [ "$content" -ne "0" ]
	then
		echo `date -u +"%Y%m%d-%H:%M:%S Error on remote"`
	fi
fi