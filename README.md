iplogger
========

Simple php IP logger for quick and easy access to your home IP.

Logs the last 2 IPs that were used to contact the web server.

Run one of the poll scripts from the device you wish to store the IP for
in a scheduled manner (for example every 5 minutes.)

IMPORTANT: Make sure you create "ip.txt" in the ip.php folder prior to use,
and to make sure it has sufficient permissions to be written to by your
php handler. (e.g. -rw-rw-r-- 1 user www-data   69 Oct 19 03:10 ip.txt)