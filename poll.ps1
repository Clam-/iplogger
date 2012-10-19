# Create scheduled task with 
# powershell.exe D:\path\to\poll.ps1

$Logfile = "poller.log"
$url = "http://domain/path/ip.php"

# http://stackoverflow.com/a/7835668
Function LogWrite
{
	Param ([string]$logstring)
	$dt = Get-Date -date (Get-Date).ToUniversalTime()-UFormat "%Y%m%d-%T "
	$logstring = $dt + $logstring
	Add-content $Logfile -value $logstring
}

$w = New-Object net.webclient
try
{
	$data = $w.DownloadString($url)
	IF ($data -ne "0")
	{
		LogWrite "Error: Error happened on remote side."
	}
}
catch [Exception]
{
	$error = "Error: " + $_
	LogWrite $error
}